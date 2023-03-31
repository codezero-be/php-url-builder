<?php

namespace CodeZero\UrlBuilder;

class UrlBuilder
{
    /**
     * The parsed URL parts.
     *
     * @var array
     */
    protected $urlParts;

    /**
     * Crate a new UrlBuilder instance.
     *
     * @param string $url
     *
     * @return \CodeZero\UrlBuilder\UrlBuilder
     */
    public static function make(string $url): UrlBuilder
    {
        return new self($url);
    }

    /**
     * Crate a new UrlBuilder instance.
     *
     * @param string $url
     */
    public function __construct(string $url)
    {
        $this->urlParts = parse_url($url) ?: [];
    }

    /**
     * Create a string from URL parts.
     *
     * @param bool $absolute
     *
     * @return string
     */
    public function build(bool $absolute = true): string
    {
        $url = '';
        $port = $this->getPort();
        $query =  $this->getQueryString();

        if ($absolute === true) {
            $port = $port ? ":{$port}" : '';
            $url .= $this->getScheme() . '://' . $this->getHost() . $port;
        }

        if ($absolute === false || $this->getPath() !== '/' || $query !== '') {
            $url .= $this->getPath();
        }

        $url .= $query ? '?' . $query : '';

        return $url;
    }

    /**
     * Get the scheme.
     *
     * @return string
     */
    public function getScheme(): string
    {
        return $this->get('scheme');
    }

    /**
     * Set the scheme.
     *
     * @param string $scheme
     *
     * @return \CodeZero\UrlBuilder\UrlBuilder
     */
    public function setScheme(string $scheme): UrlBuilder
    {
        $this->set('scheme', $scheme);

        return $this;
    }

    /**
     * Get the host.
     *
     * @return string
     */
    public function getHost(): string
    {
        return $this->get('host');
    }

    /**
     * Set the host.
     *
     * @param string $host
     *
     * @return \CodeZero\UrlBuilder\UrlBuilder
     */
    public function setHost(string $host): UrlBuilder
    {
        $this->set('host', $host);

        return $this;
    }

    /**
     * Get the port.
     *
     * @return string
     */
    public function getPort(): string
    {
        return $this->get('port');
    }

    /**
     * Set the port.
     *
     * @param string|int|null $port
     *
     * @return \CodeZero\UrlBuilder\UrlBuilder
     */
    public function setPort($port): UrlBuilder
    {
        $this->set('port', $port);

        return $this;
    }

    /**
     * Get the path.
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->get('path');
    }

    /**
     * Set the path.
     *
     * @param string $path
     *
     * @return \CodeZero\UrlBuilder\UrlBuilder
     */
    public function setPath(string $path): UrlBuilder
    {
        $this->set('path', '/' . trim($path, '/'));

        return $this;
    }

    /**
     * Get the slugs.
     *
     * @return array
     */
    public function getSlugs(): array
    {
        $path = $this->getPath();

        if ($path === '/') {
            return [];
        }

        return explode('/', trim($path, '/'));
    }

    /**
     * Set the slugs.
     *
     * @param array $slugs
     *
     * @return \CodeZero\UrlBuilder\UrlBuilder
     */
    public function setSlugs(array $slugs): UrlBuilder
    {
        $this->setPath('/' . join('/', $slugs));

        return $this;
    }

    /**
     * Get the query string.
     *
     * @return string
     */
    public function getQueryString(): string
    {
        return $this->get('query');
    }

    /**
     * Set the query string.
     *
     * @param string $query
     *
     * @return \CodeZero\UrlBuilder\UrlBuilder
     */
    public function setQueryString(string $query): UrlBuilder
    {
        $this->set('query', ltrim($query, '?'));

        return $this;
    }

    /**
     * Get the query string as an array.
     *
     * @return array
     */
    public function getQuery(): array
    {
        $query = $this->get('query');

        if ($query === '') {
            return [];
        }

        parse_str($query, $queryArray);

        return $queryArray;
    }

    /**
     * Set the query string parameters.
     *
     * @param array $query
     *
     * @return \CodeZero\UrlBuilder\UrlBuilder
     */
    public function setQuery(array $query): UrlBuilder
    {
        $this->set('query', http_build_query($query));

        return $this;
    }

    /**
     * Get the value of a URL part.
     *
     * @param string $part
     *
     * @return string
     */
    protected function get(string $part): string
    {
        return $this->urlParts[$part] ?? '';
    }

    /**
     * Set a URL part to a new value.
     *
     * @param string $part
     * @param string|null $value
     *
     * @return \CodeZero\UrlBuilder\UrlBuilder
     */
    protected function set(string $part, ?string $value): UrlBuilder
    {
        $this->urlParts[$part] = strval($value);

        return $this;
    }
}
