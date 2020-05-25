echo 'Hello from travis..'
python3 --version
pwd
echo "Running Python 3 Unit Tests"
cd unit3
rm -f cover*jpg
python3 unit.py
E3=$?
rm -f cover*jpg

if [ "$E3" -ne "0" ]; then
    echo "==== Python 3 had errors"
    EE=1
fi
exit $EE
