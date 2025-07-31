<?php

class ModalsLib
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->library('session');
    }

    public function modal_component($a_modal_component)
    {
        $s_modal_id = $a_modal_component['modal_id'];
        $s_modal_title = $a_modal_component['modal_title'];
        $s_modal_body = $a_modal_component['modal_body'];

        $s_modal_html = <<<TEXT
                <div class="modal fade" tabindex="-1" id="{$s_modal_id}">
                    <div class="modal-dialog modal-md" style="top: 10%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{$s_modal_title}</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                 {$s_modal_body}
                            </div>

                        </div>
                    </div>
                </div>
            TEXT;
        return $s_modal_html;
    }
}
