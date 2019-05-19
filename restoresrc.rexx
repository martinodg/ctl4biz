/*rexx test*/
parse arg file
say file
do while lines(file) > 0  
linestr = linein(file) 
say "Following file: " linestr
parse var linestr rut 3 restofpath
sourcedir = "../emooncp/"||restofpath
say " will be replaced from original source located at: "sourcedir
comando1 = "sed -i 's/conectar\.php/conectar7\.php/g' "||linestr
comando2 = "sed -i '/conectar7\.php/ a include \(\"'"\.\.\/mysqli_result.php\"'"\)\;' "||linestr
comando3 = "sed -i 's/mysql_\mysqli_/g' "||linestr
comando4 = "sed -i 's/mysqli_query\(\mysqli_query\($conexion\,/g' "||linestr

/*comando = "cp " sourcedir " " linestr*/
say comando
address cmd comando 
end 

