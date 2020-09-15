<?php

namespace Tanwencn\Admin\Log;

class FileLog
{
    protected $offset = -1;

    protected $filePath;

    /**
     * @var \SplFileObject
     */
    private $file;

    protected $read_rows = 0;

    protected $eof_tell;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->openFile();
    }

    public function row($number = 1)
    {
        $results = [];
        while ($number) {
            $results[] = $this->readRow();
            $number--;
        }

        return array_filter($results);
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function getReadRows()
    {
        return $this->read_rows;
    }

    protected function openFile()
    {
        $this->file = (new \SplFileInfo($this->filePath))->openFile();
    }

    protected function readLine()
    {
        $content = '';

        $this->file->fseek($this->offset, SEEK_END);
        if ($this->offset == -1) $this->eof_tell = -($this->file->ftell() + 1);

        while (!$this->eof()) {
            $char = $this->file->fgetc();

            $this->file->fseek($this->offset--, SEEK_END);

            if ($char === "\n" || $char === "\r") break;

            $content = $char . $content;
        }

        return mb_convert_encoding($content, "UTF-8");
    }

    protected function eof()
    {
        return $this->eof_tell - 1 == $this->offset + 1;
    }

    protected function readRow()
    {
        $content = [];
        $i = 0;
        do {
            if ($this->eof()) break;
            $content[$i] = trim($this->readLine());
            if (empty($content[$i])) continue;
            if (preg_match('/\[\d{4}-\d{2}-\d{2}.*?\].*/', $content[$i])) break;
        } while ($i += 1);

        $data = array_reverse(array_filter($content));

        $result = [];
        if (!empty($data)) {
            preg_match('/\[(\d{4}-\d{2}-\d{2}.*?)\] (.+?)\.(.+?): (.*)/', $data[0], $result);
            unset($result[0]);
            $result[] = implode("\n", $data);
        }

        $this->read_rows++;

        return array_values($result);
    }

    public function __sleep()
    {
        $properties = (new \ReflectionClass($this))->getProperties();

        return array_values(array_filter(array_map(function ($property) {
            return $property->isStatic() || $property->isPrivate() ? null : $property->getName();
        }, $properties)));
    }

    public function __wakeup()
    {
        if (file_exists($this->filePath))
            $this->openFile();
    }
}