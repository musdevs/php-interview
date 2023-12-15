<?php

class WrongDocument
{
    private $data;
    private $filename;

    public function open() {}

    public function save() {}
}

class WrongReadOnlyDocument
{
    public function save()
    {
        throw new Exception('Unable to save read-only file');
    }
}

class WrongProject
{
    private $documents;

    public function openAll()
    {
        foreach ($this->documents as $doc) {
            $doc.open();
        }
    }

    public function saveAll()
    {
        foreach ($this->documents as $doc) {
            // еще нарушает принцип OpenClosed
            if (!$doc instanceof WrongReadOnlyDocument) {
                $doc->save();
            }
        }
    }
}

// ********************** Правильная реализация

class Document
{
    private $data;
    private $filename;

    public function open() {}
}

class WritableDocument extends Document
{
    public function save() {}
}

class Project
{
    private $allDocuments;
    private $writebleDocuments;

    public function openAll()
    {
        foreach ($this->allDocuments as $doc) {
            $doc.open();
        }
    }

    public function saveAll()
    {
        foreach ($this->writebleDocuments as $doc) {
            $doc->save();
        }
    }
}
