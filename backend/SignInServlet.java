import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/login")
public class LoginServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        PrintWriter out = response.getWriter();
        String email = request.getParameter("email");
        String password = request.getParameter("password");

        response.setContentType("application/json");
        boolean login = validateLogin(email, password);
        out.println("{");
        out.println("\"Email\":" + "\"" + email + "\",");;
        out.println("\"Status\":" + "\"" + login + "\"");
        out.println("}");

        out.flush();
        out.close();
    }

    public static boolean validateLogin(String email, String password) {
        Connection conn = createConnection();
        Statement st = null;
        ResultSet rs = null;

        //System.out.println("Email:" + email + " Password:" + password);
        String statement = "SELECT COUNT(email) AS count FROM user WHERE email='" + email + "' AND password='"
                + password + "'";

        int count = 0;
        try {
            st = conn.createStatement();
            rs = st.executeQuery(statement);
            rs.next();
            count = rs.getInt("COUNT");

        } catch (SQLException sqle) {
            System.out.println("SQLException: " + sqle.getMessage());
        }

        closeConnection(st, conn, rs);
        if (count == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static Connection createConnection() {
        Connection conn = null;
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            // TODO: CHECK IF THIS CONNECTION WORKS
            conn = DriverManager.getConnection("jdbc:mysql://localhost/slh-respository?user=root&password=root");
        } catch (SQLException sqle) {
            System.out.println("SQLException: " + sqle.getMessage());
        } catch (ClassNotFoundException e) {
            System.out.println("CNFException: " + e.getMessage());
        }
        return conn;
    }

    public static void closeConnection(Statement st, Connection conn, ResultSet rs) {
        try {
            if (rs != null) {
                rs.close();
            }
            if (st != null) {
                st.close();
            }
            if (conn != null) {
                conn.close();
            }
        } catch (SQLException sqle) {
            System.out.println("sqle: " + sqle.getMessage());
        }
    }

}