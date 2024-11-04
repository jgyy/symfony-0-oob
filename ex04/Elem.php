<?php

class Elem {
    private $tag;
    private $content;
    private $elements = [];
    private $attributes = [];
    private static $validTags = [
        'meta', 'img', 'hr', 'br', 'html', 'head', 'body', 
        'title', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 
        'span', 'div', 'table', 'tr', 'th', 'td', 'ul', 'ol', 'li'
    ];

    public function __construct($tag, $content = null, array $attributes = []) {
        if (!in_array($tag, self::$validTags)) {
            throw new MyException("Invalid HTML tag: $tag");
        }
        
        $this->tag = $tag;
        $this->content = $content;
        $this->attributes = $attributes;
    }

    public function pushElement(Elem $elem): void {
        $this->elements[] = $elem;
    }

    private function renderAttributes(): string {
        if (empty($this->attributes)) {
            return '';
        }

        $attrs = [];
        foreach ($this->attributes as $key => $value) {
            $attrs[] = sprintf('%s="%s"', $key, htmlspecialchars($value));
        }
        return ' ' . implode(' ', $attrs);
    }

    public function getHTML(): string {
        $voidElements = ['meta', 'img', 'hr', 'br'];
        if (in_array($this->tag, $voidElements)) {
            return sprintf('<%s%s />', $this->tag, $this->renderAttributes());
        }

        $html = sprintf('<%s%s>', $this->tag, $this->renderAttributes());

        if ($this->content !== null) {
            $html .= htmlspecialchars($this->content);
        }

        foreach ($this->elements as $element) {
            $html .= $element->getHTML();
        }
        
        $html .= sprintf('</%s>', $this->tag);
        
        return $html;
    }
}

?>
