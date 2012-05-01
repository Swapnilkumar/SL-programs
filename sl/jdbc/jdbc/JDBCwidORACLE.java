/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor. (ORACLE)
 */
package jdbc;

import java.io.*;
import java.sql.*;


public class Main {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws IOException {
        // TODO code application logic here
//    dbConnection c=new dbConnection();


        String dbDriver = "sun.jdbc.odbc.JdbcOdbcDriver";
        String url = "jdbc:odbc:login";
        String sQuery;
        String dbUser = "scott";
        String dbPassword = "tiger";

        Connection conn = null;
        ResultSet rs = null;
        Statement stmt = null;
        //PreparedStatement stmt =null; //new PreparedStatement();

        //1.Load the Driver
        try {
            Class.forName(dbDriver);
        } catch (ClassNotFoundException cnf) {
            System.out.println("Class Not Found" + cnf);
        }

        //2.Open Connection
        try {
            conn = DriverManager.getConnection(url, dbUser, dbPassword);   //Connection obj
            stmt = conn.createStatement();    //Stmt obj.
            //      rs=stmt.executeQuery(sQuery);   //Resultset
        } catch (SQLException sqe) {
            sqe.printStackTrace();
        }

        //      dbFunctions f = new dbFunctions();
        Integer choice = null;
        Integer studentId, flg = 0;
        String studentName;
        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
        Boolean b = true;
        try {
            while (true) {
                System.out.println("Menu:\n1.Insert\n2.Update\n3.Search\n4.Display\n5.Delete\n6.Exit\n==>");
                try {
                    choice = Integer.parseInt(br.readLine());
                } catch (IOException e) {
                    e.printStackTrace();
                }

                switch (choice) {
                    case 1:
                        System.out.println("Student ID = ");
                        studentId = Integer.parseInt(br.readLine());
                        System.out.println("Student Name = ");
                        studentName = br.readLine();
                        sQuery = "insert into student values(" + studentId + ",'" + studentName + "')";
                        stmt.executeUpdate(sQuery);
                        break;

                    case 2:
                        System.out.println("Student ID = ");
                        studentId = Integer.parseInt(br.readLine());
                        System.out.println("Student Name = ");
                        studentName = br.readLine();
                        sQuery = "update student set name='" + studentName + "' where rollno=" + studentId;
                        stmt.executeUpdate(sQuery);
                        break;

                    case 3:
                        sQuery = "Select * from Student";
                        rs = stmt.executeQuery(sQuery);
                        System.out.println("Enter Student ID =");
                        studentId = Integer.parseInt(br.readLine());

                        while (rs.next()) {
                            if (rs.getInt(1) == studentId) {
                                System.out.println("Student Name : " + rs.getString(2));
                                flg = 1;
                                break;
                            }
                        }
                        if (flg == 0) {
                            System.out.println("Record Not Found");
                        }
                        break;

                    case 4:
                        sQuery = "Select * from Student";
                        rs = stmt.executeQuery(sQuery);
                        while (rs.next()) {
                            System.out.println(rs.getInt(1) + "  " + rs.getString(2));
                        }
                        break;

                    case 5:
                        System.out.println("Student ID = ");
                        studentId = Integer.parseInt(br.readLine());
                        sQuery = "delete from student where rollno=" + studentId;
                        stmt.executeUpdate(sQuery);
                        break;

                    case 6:
                        b = false;
                        System.exit(0);
                }


            }

        } catch (SQLException sqe) {
            sqe.printStackTrace();
            sqe.getNextException();
        }
        catch(Exception ee){
            ee.printStackTrace();
        }




    }
}
/*********************OUTPUT*******************************
 * 
 * run:
Menu:
1.Insert
2.Update
3.Search
4.Display
5.Delete
6.Exit
==>
1
Student ID = 
3
Student Name = 
Ashish
Menu:
1.Insert
2.Update
3.Search
4.Display
5.Delete
6.Exit
==>
4
2  Ashwin
3  Ashish
Menu:
1.Insert
2.Update
3.Search
4.Display
5.Delete
6.Exit
==>
1
Student ID = 
5
Student Name = 
AAA
Menu:
1.Insert
2.Update
3.Search
4.Display
5.Delete
6.Exit
==>

 * 
 * 
 * 
 * 
 */