<?php

class Elem {
    private $tag;
    private $content;
    private $elements = [];
    private static $validTags = [
        'meta', 'img', 'hr', 'br', 'html', 'head', 
        'body', 'title', 'h1', 'h2', 'h3', 'h4', 
        'h5', 'h6', 'p', 'span', 'div'
    ];

    public function __construct($tag, $content = null) {
        if (!in_array($tag, self::$validTags)) {
            throw new Exception("Invalid HTML tag: $tag");
        }
        $this->tag = $tag;
        $this->content = $content;
    }

    public function pushElement(Elem $elem) {
        $this->elements[] = $elem;
    }

    public function getHTML() {
        $selfClosing = ['meta', 'img', 'hr', 'br'];
        if (in_array($this->tag, $selfClosing)) {
            return "<{$this->tag}>";
        }

        $html = "<{$this->tag}>";

        if ($this->content !== null) {
            $html .= htmlspecialchars($this->content);
        }

        foreach ($this->elements as $element) {
            $html .= $element->getHTML();
        }

        $html .= "</{$this->tag}>";
        return $html;
    }
}

?>
