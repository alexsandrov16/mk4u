<?php

namespace Mk4U\Http;

/**
 * Header Trait
 */
trait Header
{

    protected string $version = '1.1';
    protected array $headers = [];
    protected mixed $body;

    /**
     * Mostrar Version del Protocolo Http
     */
    public function getProtocolVersion(): string
    {
        return $this->version;
    }

    /**
     * Establecer Version del Protocolo Http
     */
    public function setProtocolVersion(string $version): static
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Obtener todas las Cabeceras
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Mostrar cabecera
     */
    public function getHeader(string $name): array|string
    {
        if ($this->hasHeader($name)) {
            return $this->headers[$this->sanitizeHeader($name)];
        }
        return [];
    }

    /**
     * Obtener valores de cabecera como string
     *//*
    public function getHeaderLine($name): string
    {
        if (!$this->hasHeader($name)) {
            return '';
        }

        return implode(', ', array_values($this->getHeader($name)));
    }*/

    /**
     * Verificar si existe una cabecera
     */
    public function hasHeader(string $name): bool
    {
        return key_exists($this->sanitizeHeader($name), $this->headers);
    }

    /**
     * Establecer cabecera
     */
    public function setHeader(string $name, string|array $value): static
    {
        $this->headers[$this->sanitizeHeader($name)] = $value;

        return $this;
    }

    /**
     * Establecer todas las cabeceras
     */
    public function setHeaders(array $headers): static
    {
        foreach ($headers as $name => $value) {
            $this->setHeader($name, $value);
        }

        return $this;
    }

    /**
     * Agregar cabecera
     * 
     * Si existe se agrega el valor al final
     */
    public function addHeader(string $name, string|array $value): static
    {
        if (!$this->hasHeader($name)) {
            return $this->setHeader($name, $value);
        }
        array_merge($this->headers[$this->sanitizeHeader($name)], [$name => $value]);
        return $this;
    }

    /**
     * Eliminar Cabecera
     */
    public function removeHeader(string $name): static
    {
        if ($this->hasHeader($name)) unset($this->headers[$this->sanitizeHeader($name)]);
        return $this;
    }

    /**
     * Estandarizar nombre de cabecera
     */
    public function sanitizeHeader(string $name): string
    {
        return str_replace(' ', '-', ucwords(str_replace(['-', '_'], ' ', $name)));
    }

    /**
     * Devuelve cuerpo del mensaje
     */
    public function getBody(): mixed
    {
        return $this->body;
    }

    /**
     * Establece cuerpo del mensaje
     */
    public function setBody(mixed $body = NULL): static
    {
        $this->body = $body;
        return $this;
    }
}
