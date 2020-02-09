<?php

use Base\SysEmail as BaseSysEmail;

/**
 *
 */
class SysEmail extends BaseSysEmail
{
    use Validatable;

    static $validationRules = [
        'Code' => [
            'null' => false, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 30],
        ],
        'Name' => [
            'null' => false, 'blank'=> false,
            'size'=> ['min' => 3, 'max' => 100],
        ],
        'Description' => [
            'null' => true, 'blank'=> false,
        ],
        'FromEmail' => [
            'null' => false, 'blank'=> false,
            'email' => true, 'size' => ['min' => 10, 'max' => 100],
        ],
        'FromName' => [
            'null' => false, 'blank'=> false,
            'size' => ['min' =>2, 'max' => 100],
        ],
        'Cc' => [
            'null' => true, 'blank'=> false,
            'size' => ['min' => 10, 'max' => 2000],
        ],
        'Bcc' => [
            'null' => true, 'blank'=> false,
            'size' => ['min' => 10, 'max' => 500],
        ],
        'Subject' => [
            'null' => false, 'blank'=> false,
            'size' => ['min' => 5, 'max' => 200],
        ],
        'Body' => [
            'null' => false, 'blank'=> false,
        ],
        'Attachments' => [
            'null' => true, 'blank'=> false,
            'size' => ['min' => 5, 'max' => 2000],
        ],
        'Template' => [
            'null' => true, 'blank'=> false,
            'size' => ['min' => 1, 'max' => 50],
        ],
    ];

    public function preSave()
    {
        $this->code = trim($this->code)!=''? strtoupper(trim($this->code)): null;
        $this->name = trim($this->name)!=''? trim($this->name): null;
        $this->description = trim($this->description)!=''? trim($this->description): null;
        $this->cc = trim($this->cc)!=''? trim($this->cc): null;
        $this->bcc = trim($this->bcc)!=''? trim($this->bcc): null;
        $this->subject = trim($this->subject)!=''? trim($this->subject): null;
        $this->body = trim($this->body)!=''? trim($this->body): null;
        $this->template = trim($this->template)!=''? trim($this->template): null;
        return parent::preSave();
    }

    public function preValidate()
    {
        return $this->preSave();
    }

    public function preInsert()
    {
        return $this->preSave();
    }

    public function preUpdate()
    {
        return $this->preSave();
    }

    /**
     * @return array
     */
    public function attachmentsList()
    {
        //TODO: manage attachments
        return [];
    }

}
