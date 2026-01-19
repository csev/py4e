# Test Troubleshooting Guide

## Common Issues

### Port 9515 Already in Use

**Error**: `The port 9515 is already in use`

**Cause**: ChromeDriver is already running from a previous test that didn't quit properly. Often, a PHP process is still connected to ChromeDriver, so killing ChromeDriver just causes it to restart.

**Solutions**:

1. **Use the cleanup script** (recommended):
   ```bash
   ./tests/cleanup-test-processes.sh
   ```

2. **Manual cleanup**:
   ```bash
   # Check what's using the port
   lsof -i :9515
   
   # Kill PHP processes connected to ChromeDriver
   lsof -ti :9515 | xargs kill
   
   # Then kill ChromeDriver
   pkill chromedriver
   
   # Verify port is free
   lsof -i :9515
   ```

3. **Nuclear option** (if above doesn't work):
   ```bash
   # Force kill everything on port 9515
   lsof -ti :9515 | xargs kill -9
   pkill -9 chromedriver
   ```

4. **Prevent future issues**: Make sure tests always call `$client->quit()` to clean up browser instances. The cleanup script helps when tests crash before cleanup.

### Browser Window Stays Open

**Symptom**: Browser windows remain open after tests complete.

**Cause**: Test didn't call `$client->quit()` or crashed before cleanup.

**Solution**: Always ensure `$client->quit()` is called, even in error cases:
```php
try {
    // test code
} finally {
    $client->quit();
}
```

### Tests Hang/Timeout

**Symptom**: Tests hang indefinitely waiting for elements.

**Cause**: 
- Element selector is wrong
- Page takes longer to load than expected
- Iframe not loading

**Solutions**:
- Increase timeout values
- Use `--watch` mode to see what's happening
- Check element selectors match actual HTML
- Add more `sleep()` delays if needed

### "No such element" Errors

**Symptom**: `no such element: element not found`

**Cause**: Element selector doesn't match page structure.

**Solutions**:
- Run with `--watch` to inspect page
- Check actual HTML structure
- Use more flexible selectors
- Add waits before accessing elements

### Multiple Browser Windows Open

**Symptom**: Many browser windows open during test run.

**Cause**: Tests creating new clients without closing old ones.

**Solution**: Ensure each test method calls `$client->quit()`:
```php
public function testSomething()
{
    $client = $this->getPantherClient();
    try {
        // test code
    } finally {
        $client->quit();
    }
}
```

## Debugging Tips

### Use Watch Mode

Always use `--watch` when debugging:
```bash
php tests/ToolsTests/AipaperTest.php --watch
```

This shows the browser window so you can see what's happening.

### Check Process List

See what's running:
```bash
ps aux | grep -E "(chromedriver|chrome|php)" | grep -v grep
```

### Check Port Usage

See what's using ports:
```bash
lsof -i :9515  # ChromeDriver port
lsof -i :8888  # Your web server port
```

### Clean Up Everything

Nuclear option - kill all related processes:
```bash
pkill -9 chromedriver
pkill -9 "Google Chrome"
pkill -9 php
```

Then restart your web server and try again.

## Prevention

1. **Always quit clients**: Every test should call `$client->quit()`
2. **Use try/finally**: Ensure cleanup happens even on errors
3. **Check for existing processes**: Before starting tests, check if ChromeDriver is already running
4. **Use timeouts**: Don't let tests hang indefinitely
