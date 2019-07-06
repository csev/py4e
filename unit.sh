echo 'Hello from travis..'
python --version
python3 --version
pwd
echo "Running Python 3 Unit Tests"
cd unit3
python3 unit.py
E3=$?
rm cover*jpg

EE=0
if [ "$E3" -ne "0" ]; then
    echo "==== Python 3 had errors"
    EE=1
fi
exit $EE
