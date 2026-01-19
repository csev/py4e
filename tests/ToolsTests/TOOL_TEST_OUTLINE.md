# Tool Testing Outline - For Better Test Implementation

If you can provide details about how the `/tools` test harness works, I can write more accurate tests. Here's what would be helpful:

## What I Need to Know

### 1. Tool Discovery
- How are tools listed on `/tools`?
  - Is there a list/grid of tool cards?
  - What HTML structure? (e.g., `<div class="tool-card">`, `<a href="/tools/{name}">`, etc.)
  - How do I find a specific tool (by name, by link, by button)?

### 2. Tool Launch
- How do you launch a tool?
  - Click a link/button on `/tools`?
  - Navigate directly to `/tools/{toolKey}`?
  - Does it require selecting a test account first?
  
### 3. Test Account Selection
- How do you select test accounts (Jane Instructor, Sue Student, etc.)?
  - Dropdown menu?
  - Tab selection?
  - Query parameter (`?identity=instructor`)?
  - Before or after tool launch?

### 4. Iframe Structure
- When does the iframe appear?
  - Immediately on page load?
  - After clicking something?
  - After form submission?
- What are the iframe selectors?
  - Class: `lti_frameResize`?
  - ID?
  - Other attributes?
- How long does it take to load?

### 5. Tool-Specific Testing
- What should I test for aipaper specifically?
  - Does it have a form to fill out?
  - Buttons to click?
  - Specific text/content to verify?
  - Workflow steps?

## Current Understanding

Based on code inspection, I understand:
- `/tools` redirects to `/tsugi/store/test`
- Tools can be accessed via `/tools/{toolKey}`
- Query parameter `?identity=instructor` selects test account
- Tools launch in iframes
- Iframe may have class `lti_frameResize` or be regular `<iframe>`

## What's Not Working

The current test:
1. ✅ Finds tool in harness listing
2. ❌ Cannot find iframe when navigating to `/tools/aipaper`
3. ❌ Cannot verify tool launch

Possible reasons:
- Tool doesn't auto-launch (needs manual click?)
- Iframe takes longer to appear
- Different iframe selector needed
- Tool registration issue
- Page structure differs

## How You Can Help

Provide a brief outline like:

```
1. Navigate to /tools
2. See list of tools (cards/links)
3. Click on "aipaper" tool card/link
4. Page loads with tabs: Test, Identity, Debug
5. Test tab is active by default
6. Tool automatically launches in iframe (class="lti_frameResize")
7. Iframe appears within 2-3 seconds
8. Switch to iframe to test tool content
```

Or if it's different:
- What's the actual flow?
- What HTML elements should I look for?
- What selectors work?

This will help me write a much better test!
