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
 * Defines the question class for the dictation PoC question type.
 *
 * @package    qtype_dictationpoc
 * @copyright  2025 David Kelly
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/questionbase.php');

/**
 * The question class for dictation questions.
 */
class qtype_dictationpoc_question extends question_graded_automatically {

    /** @var string The full sentence with or without blanks. */
    public $sentence;

    /** @var string The URL to the audio file. */
    public $audiourl;

    /**
     * Return the structure of student responses.
     *
     * @return array
     */
    public function get_expected_data() {
        return ['response' => PARAM_RAW];
    }

    /**
     * Summarise the student response.
     *
     * @param array $response
     * @return string
     */
    public function summarise_response(array $response) {
        return isset($response['response']) ? s($response['response']) : '';
    }

    /**
     * Check if the response is complete.
     *
     * @param array $response
     * @return bool
     */
    public function is_complete_response(array $response) {
        return !empty($response['response']);
    }

    /**
     * Check if the response is gradable.
     *
     * @param array $response
     * @return bool
     */
    public function is_gradable_response(array $response) {
        return $this->is_complete_response($response);
    }

    /**
     * Get the correct answer for display.
     *
     * @return array
     */
    public function get_correct_response() {
        return ['response' => $this->sentence];
    }

    /**
     * Grade the student response.
     *
     * @param array $response
     * @return array (float grade, question_state)
     */
    public function grade_response(array $response) {
        // Placeholder: exact match only.
        if (trim($response['response']) === trim($this->sentence)) {
            return [1.0, question_state::$gradedright];
        }

        return [0.0, question_state::$gradedwrong];
    }

    /**
     * Check if two responses are the same.
     *
     * @param array $prevresponse
     * @param array $newresponse
     * @return bool
     */
    public function is_same_response(array $prevresponse, array $newresponse) {
        return $prevresponse['response'] === $newresponse['response'];
    }

    /**
     * Validate the response.
     *
     * @param array $response
     * @return string|null
     */
    public function get_validation_error(array $response) {
        if (trim($response['response']) === '') {
            return get_string('pleaseenterananswer', 'question');
        }

        return null;
    }
}
