<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Question type class for the dictation PoC question.
 *
 * @package    qtype_dictationpoc
 * @copyright  2025 David Kelly
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/questionlib.php');

/**
 * The question type class for dictation PoC.
 */
class qtype_dictationpoc extends question_type {

    public function save_question_options($question) {
        global $DB;

        $DB->delete_records('qtype_dictationpoc_options', ['questionid' => $question->id]);

        $data = new stdClass();
        $data->questionid = $question->id;
        $data->audiourl = $question->audiofile ?? '';
        $data->sentence = $question->questiontext ?? '';

        $DB->insert_record('qtype_dictationpoc_options', $data);
    }

    public function get_question_options($question) {
        global $DB;

        if (!$options = $DB->get_record('qtype_dictationpoc_options', ['questionid' => $question->id])) {
            debugging('Missing options for dictation question ' . $question->id, DEBUG_DEVELOPER);
            return false;
        }

        $question->options = $options;
        $question->audiourl = $options->audiourl;
        $question->sentence = $options->sentence;

        return true;
    }
}
