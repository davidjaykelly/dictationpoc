# Moodle Question Type: Dictation (Proof-of-Concept)

A proof-of-concept custom Moodle question type designed for dictation-style English testing. This question type allows teachers to upload an audio file and a sentence, which students will listen to and transcribe by filling in blanks.

## Features (in Proof-of-Concept version)
- Register a custom question type (`qtype_dictationpoc`)
- Teacher UI for:
  - Uploading an audio file (MP3 or other Moodle-supported formats)
  - Entering a sentence manually (with plans to support underscore-based blanks)
- Student UI for:
  - Playing the audio
  - Submitting a single text response

## Not Yet Implemented (Planned for Full Version)
- Word-level blank handling with per-word input boxes
- Levenshtein-based automatic scoring of each hidden word
- Immediate feedback with correct/incorrect word highlights
- CSV export of student responses and scores

## Installation
1. Clone or copy this plugin folder into:
   ```
   moodle/question/type/dictationpoc
   ```
2. Visit the **Site Administration > Notifications** page to trigger installation.
3. Create a new quiz and add a "Dictation (PoC)" question to try it out.

## Author
David Kelly (2025)
https://davidkel.ly

## License
GNU GPL v3 or later - see [LICENSE](https://www.gnu.org/licenses/gpl-3.0.html)
