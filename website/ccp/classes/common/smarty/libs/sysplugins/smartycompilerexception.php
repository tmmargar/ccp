<?php

/**
 * Smarty compiler exception class
 *
 * @package Smarty
 */
class SmartyCompilerException extends SmartyException
{
    /**
     * The constructor of the exception
     *
     * @param string         $message  The Exception message to throw.
     * @param int            $code     The Exception code.
     * @param string|NULL    $filename The filename where the exception is thrown.
     * @param int|NULL       $line     The line number where the exception is thrown.
     * @param Throwable|NULL $previous The previous exception used for the exception chaining.
     */
    public function __construct(
        string $message = "",
        int $code = 0,
        ?string $filename = NULL,
        ?int $line = NULL,
        Throwable $previous = NULL
    ) {
        parent::__construct($message, $code, $previous);

        // These are optional parameters, should be be overridden only when present!
        if ($filename) {
            $this->file = $filename;
        }
        if ($line) {
            $this->line = $line;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return ' --> Smarty Compiler: ' . $this->message . ' <-- ';
    }

    /**
     * @param int $line
     */
    public function setLine($line)
    {
        $this->line = $line;
    }

    /**
     * The template source snippet relating to the error
     *
     * @type string|NULL
     */
    public $source = NULL;

    /**
     * The raw text of the error message
     *
     * @type string|NULL
     */
    public $desc = NULL;

    /**
     * The resource identifier or template name
     *
     * @type string|NULL
     */
    public $template = NULL;
}
