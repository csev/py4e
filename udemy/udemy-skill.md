# PY4E → Udemy copy (from Whisper transcripts)

Generate paste-ready Udemy course fields from the course structure and lecture transcripts.

## Inputs

- `lessons.json` — chapter titles and structure
- `whisper/txt/<chapter>/` — lecture transcripts for that chapter
- Scope: only chapters that have transcript folders under `whisper/txt/`

## Voice

Beginner-friendly, practical, Dr. Chuck / PY4E tone. No hype. No invented features, tools, certificates, or job outcomes that are not in the course.

## Produce (markdown, paste-ready)

### What will students learn in your course?

At least 4 **course-level** learning objectives or outcomes (not one per chapter).
Each should be short and outcome-shaped (“You will be able to…”), grounded in what the lectures actually teach.

### Chapter learning objectives

One learning objective per chapter folder under `whisper/txt/`.
Combine that chapter’s lecture transcripts into a single chapter outcome; do not write one bullet per video part.
Use the chapter title from `lessons.json` when labeling each objective.

### What are the requirements or prerequisites for taking your course?

List required skills, experience, tools, or equipment.
If there are no hard requirements, use this space to lower the barrier for beginners.
Only name tools the course actually uses.

### Who is this course for?

Clear description of the intended learners who will find this content valuable.

### Course Landing Page

- **Course title** (≤ 60 characters)
- **Course subtitle** (≤ 120 characters)
- **Course description** (minimum 200 words)
- **Welcome message**
- **Congratulations message**

## Rules

- Ground every claim in `lessons.json` and the transcripts
- Prefer concrete skills (e.g. read files, use dictionaries) over vague “understand Python”
- Do not invent later-chapter topics that have no transcript folder yet
- Keep Udemy length limits in mind; edit for clarity over completeness
