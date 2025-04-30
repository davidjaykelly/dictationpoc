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
 * Form for editing dictation PoC questions.
 *
 * @package    qtype_dictationpoc
 * @copyright  2025 David Kelly
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot . '/question/type/edit_question_form.php');

/**
 * Question editing form for dictation PoC question type.
 *
 * @package    qtype_dictationpoc
 * @copyright  2025 David Kelly
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_dictationpoc_edit_form extends question_edit_form {

    /**
     * Adds custom form fields to the question editing form.
     *
     * @param MoodleQuickForm $mform
     */
    protected function definition_inner($mform) {
        $mform->addElement('filepicker', 'audiofile', get_string('audiofile', 'qtype_dictationpoc'), null, [
            'accepted_types' => ['audio'],
            'maxbytes' => 10485760, // 10MB
        ]);
        $mform->addRule('audiofile', null, 'required', null, 'client');
        $mform->addRule('questiontext', null, 'required', null, 'client');
    }

    /**
     * Prepares question data for editing form.
     *
     * @param object $question
     * @return object
     */
    protected function data_preprocessing($question) {
        $question = parent::data_preprocessing($question);
        return $question;
    }

    /**
     * Returns the question type name.
     *
     * @return string
     */
    public function qtype() {
        return 'dictationpoc';
    }
}
