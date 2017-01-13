We would like to implement a table for displaying information from our application. Our current recommendation is https://editor.datatables.net/

• Client read/write via an AJAX API
• Laravel 5.3 and MySQL backend
• Search based on data in the row
• Ability to sort by column
• Change sequence of rows
• Save changes to the database
• Add Button that loads modal form and adds a row to the datatable
• Edit button that allows all the fields to be modified (can be modal or redirect to a new page)
• Implement Excel, PDF, Print and CSV buttons (listed in sequence of priority for code implementation)
• Use a bootstrap base style sheet

1) install xampp-win32-5.6.24-0-VC11-installer.exe to C:\
2) C:\xampp\htdocs\laravel-datatables
3) C:\xampp\apache\conf\extra\httpd-vhosts.conf

listen 9000
<VirtualHost *:9000>
    DocumentRoot "C:\xampp\htdocs\laravel-datatables\public"
    ServerAdmin laravel.dev
    <Directory "C:\xampp\htdocs\laravel-datatables">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

4) XAMPP restart
5) laravel-test.sql
6) localhost:9000/datatable1
