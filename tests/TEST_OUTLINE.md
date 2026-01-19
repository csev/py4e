# Py4E Test Suite Outline

## Overview
This document outlines the test structure for comprehensive testing of the py4e application using Symfony Panther.

## Test Categories

### 1. Smoke Tests (`SmokeTest.php`)
**Purpose**: Quick verification that basic functionality works
**Run Before**: Every commit
**Duration**: ~30 seconds

**Tests**:
- ✓ Homepage loads
- ✓ Lessons page loads  
- ✓ Lesson module loads
- ✓ Tools directory accessible
- ✓ Mod directory accessible

### 2. Py4E Core Tests (`Py4ETests/`)

#### LessonsTest.php
- Lessons list page renders
- Navigation to modules
- Previous/Next navigation
- Items array format rendering (Lessons2)
- Progress badges display
- Module descriptions render
- Video embeds work
- Slide links work
- Reference links work
- LTI launches (if logged in)
- Discussion links (if logged in)

#### HomePageTest.php (to be created)
- Homepage loads correctly
- Navigation menu works
- Links are valid
- Responsive design (mobile/desktop)

#### MaterialsTest.php (to be created)
- Materials page loads
- Download links work
- OER export works

### 3. Tools Tests (`ToolsTests/`)

#### ToolsTestHarnessTest.php ⭐
**This is the main way to test ALL tools (including mod tools)**
- Test harness loads at `/tools` (goes to `/tsugi/store/test`)
- Shows available tools
- Iframe launches work
- Test accounts available (Jane Instructor, Sue Student, Jane Student)
- Tool discovery and listing

**Note**: The test harness uses iframes to launch tools, so tests handle iframe navigation.

#### PythonAutoTest.php
- Tool loads without errors
- Exercise interface renders
- Code editor loads
- Submit functionality (if logged in)
- Grade recording (if logged in)

#### PythonDataTest.php (to be created)
- Tool loads
- Exercise selection works
- Data file access works
- Submission works

#### SqlIntroTest.php (to be created)
- Tool loads
- Database exercises work
- Query interface works

### 4. Tools Test Harness (`ToolsTests/ToolsTestHarnessTest.php`)

**Important**: Mod tools are NOT tested directly via `/mod` URLs. Instead, they are tested through the tools test harness at `/tools` (which goes to `/tsugi/store/test`).

#### ToolsTestHarnessTest.php
- Test harness loads
- Shows available tools (including mod tools)
- Iframe launches work
- Test accounts available (Jane Instructor, Sue Student, Jane Student)
- Tool discovery and listing

**Note**: The test harness uses iframes to launch tools, so tests need to handle iframe navigation.

## Test Execution Strategy

### Pre-Commit (Quick)
```bash
php tests/SmokeTest.php
```

### Pre-Push (Medium)
```bash
php tests/run-all.php
```

### Full Suite (Before Release)
```bash
# Run all tests with detailed output
php tests/run-all.php --verbose

# Run specific test suite
php tests/Py4ETests/LessonsTest.php
```

## Test Data Requirements

### Test Users Needed:
1. **Instructor User**
   - Can access admin features
   - Can create assignments
   - Can view analytics

2. **Student User**
   - Can submit assignments
   - Can view grades
   - Can participate in discussions

### Test Configuration:
- Base URL: `http://localhost:8888/py4e`
- Test database (separate from production)
- Test LTI keys (if testing LTI features)

## Coverage Goals

### Critical Paths (Must Test):
- ✓ Lessons rendering (legacy and items array)
- ✓ Module navigation
- ✓ Tool launches
- ✓ Authentication flows
- ✓ Grade recording

### Important Paths (Should Test):
- Progress tracking
- Badge awarding
- Discussion participation
- File uploads/downloads
- Settings pages

### Nice to Have:
- Responsive design testing
- Performance testing
- Accessibility testing
- Cross-browser testing

## Future Enhancements

1. **Visual Regression Testing**
   - Screenshot comparison
   - Detect UI changes

2. **Performance Testing**
   - Page load times
   - API response times

3. **Accessibility Testing**
   - WCAG compliance
   - Screen reader compatibility

4. **Mobile Testing**
   - Responsive design verification
   - Touch interactions

5. **CI/CD Integration**
   - GitHub Actions
   - Automated test runs on PRs
   - Test reports

## Notes

- Tests should be independent (can run in any order)
- Tests should clean up after themselves
- Use test database, not production
- Mock external services when possible
- Keep tests fast (< 5 minutes total)
