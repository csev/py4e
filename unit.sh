echo 'Hello from travis..'
pwd
echo "Running Python 3 Unit Tests"
cd unit3
python3 unit.py
rm cover*jpg

echo "Running Python 2 Unit Tests"
cd ../unit2
python3 unit.py
rm cover*jpg

