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
 * Renderer for the dictation PoC question type.
 *
 * @package    qtype_dictationpoc
 * @copyright  2025 David Kelly
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/rendererbase.php');
require_once($CFG->libdir . '/outputcomponents.php');

/**
 * Renders the dictation PoC question.
 */
class qtype_dictationpoc_renderer extends qtype_renderer {

    /**
     * Renders the question formulation and input controls.
     *
     * @param question_attempt $qa
     * @param question_display_options $options
     * @return string
     */
    public function formulation_and_controls(question_attempt $qa, question_display_options $options) {
        $question = $qa->get_question();
        $response = $qa->get_last_qt_var('response', '');

        $output = html_writer::start_div('dictationpoc-question');

        // Audio playback block.
        if (!empty($question->audiourl)) {
            $output .= html_writer::tag('audio',
                html_writer::empty_tag('source', [
                    'src' => $question->audiourl,
                    'type' => 'audio/mpeg',
                ]),
                ['controls' => 'controls']
            );
        }

        // Response input box.
        $inputname = $qa->get_qt_field_name('response');
        $attributes = [
            'type' => 'text',
            'name' => $inputname,
            'value' => $response,
            'size' => 80,
        ];

        if ($options->readonly) {
            $attributes['readonly'] = 'readonly';
        }

        $output .= html_writer::empty_tag('input', $attributes);
        $output .= html_writer::end_div();

        return $output;
    }
}
