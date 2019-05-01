var mysql = require('mysql');
 
console.log('Get connection ...');
 
var conn = mysql.createConnection({
  database: 'bsuir_olympiad',
  host: "192.168.1.99",
  user: "root",
  password: "root"
});
 
conn.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
});

var sql1 = "INSERT INTO accounts (email, password, userType) values ('greerz1212@gmail.com', '1212', 'admin')";
 
conn.query(sql1, function(err, results) {
    if (err) throw err;
    console.log("Inserted successfully.");
});