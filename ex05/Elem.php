<?php

class Elem {
    private string $tag;
    private ?string $content;
    private array $attributes;
    private array $children;
    private static array $validTags = [
        'meta', 'img', 'hr', 'br', 'html', 'head', 'body', 'title',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'span', 'div',
        'table', 'tr', 'th', 'td', 'ul', 'ol', 'li'
    ];

    public function __construct(string $tag, ?string $content = null, array $attributes = []) {
        if (!in_array($tag, self::$validTags)) {
            throw new MyException("Invalid HTML tag: $tag");
        }
        $this->tag = $tag;
        $this->content = $content;
        $this->attributes = $attributes;
        $this->children = [];
    }

    public function pushElement(Elem $elem): void {
        $this->children[] = $elem;
    }

    private function renderAttributes(): string {
        if (empty($this->attributes)) {
            return '';
        }
        
        $attrs = [];
        foreach ($this->attributes as $key => $value) {
            $attrs[] = sprintf('%s="%s"', $key, htmlspecialchars($value, ENT_QUOTES));
        }
        return ' ' . implode(' ', $attrs);
    }

    public function getHTML(): string {
        $html = "<{$this->tag}{$this->renderAttributes()}>";
        
        if ($this->content !== null) {
            $html .= htmlspecialchars($this->content, ENT_QUOTES);
        }
        
        foreach ($this->children as $child) {
            $html .= $child->getHTML();
        }
        
        if (!in_array($this->tag, ['meta', 'img', 'hr', 'br'])) {
            $html .= "</{$this->tag}>";
        }
        
        return $html;
    }

    public function validPage(): bool {
        if ($this->tag !== 'html') {
            return false;
        }

        if (count($this->children) !== 2) {
            return false;
        }

        $head = $this->children[0];
        $body = $this->children[1];

        if ($head->tag !== 'head' || $body->tag !== 'body') {
            return false;
        }

        $hasTitle = false;
        $hasMetaCharset = false;
        foreach ($head->children as $child) {
            if ($child->tag === 'title') {
                if ($hasTitle) return false;
                $hasTitle = true;
            } elseif ($child->tag === 'meta') {
                if (isset($child->attributes['charset'])) {
                    if ($hasMetaCharset) return false;
                    $hasMetaCharset = true;
                }
            }
        }
        if (!$hasTitle || !$hasMetaCharset) {
            return false;
        }

        return $this->validateStructure($body);
    }

    private function validateStructure(Elem $elem): bool {
        if ($elem->tag === 'p') {
            return empty($elem->children);
        }

        if ($elem->tag === 'table') {
            foreach ($elem->children as $child) {
                if ($child->tag !== 'tr') {
                    return false;
                }
            }
        }

        if ($elem->tag === 'tr') {
            foreach ($elem->children as $child) {
                if ($child->tag !== 'th' && $child->tag !== 'td') {
                    return false;
                }
            }
        }

        if ($elem->tag === 'ul' || $elem->tag === 'ol') {
            foreach ($elem->children as $child) {
                if ($child->tag !== 'li') {
                    return false;
                }
            }
        }

        foreach ($elem->children as $child) {
            if (!$this->validateStructure($child)) {
                return false;
            }
        }

        return true;
    }
}

?>
