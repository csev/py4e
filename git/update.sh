#! /bin/sh	

echo "Make sure to run this in the git directory"

echo "Make sure to run py4inf/code/cleanup.sh"

cp -r py4inf/code/* ../code
cd ..
rm code.zip
zip -r code.zip code

echo "pythonlearn/code updated."

