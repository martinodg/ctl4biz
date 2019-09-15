#You can use a loop to read each line of your file and put it into the array
# Read the file in parameter and fill the array named "array"
getArray() {
    array=() # Create array
    while IFS= read -r line # Read a line
    do
        array+=("$line") # Append line to the array
    done < "$1"
}
echo "Now I will read your file"
getArray "treeprint.txt" 

#How to use your array :
# Print the file (print each element of the array)
getArray  "treeprint.txt" 
for e in "${array[@]}"
do
    echo "$e"
    getArray "$e"
	#sed -i '/include ("../conectar7.php");/a include ("../mysqli_result.php");' "$e"
done


