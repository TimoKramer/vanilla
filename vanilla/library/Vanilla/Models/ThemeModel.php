<?php
/**
 * @copyright 2009-2019 Vanilla Forums Inc.
 * @license GPL-2.0-only
 */

namespace Vanilla\Models;

use Vanilla\Theme\VariablesProviderInterface;
use Garden\Web\Exception\ClientException;
use Vanilla\Theme\ThemeProviderInterface;

/**
 * Handle custom themes.
 */
class ThemeModel {
    const ASSET_LIST = [
        "header" => [
            "type" => "html",
            "file" => "header.html",
            "default" => "",
            "mime-type" => "text/html"
        ],
        "footer" => [
            "type" => "html",
            "file" => "footer.html",
            "default" => "",
            "mime-type" => "text/html"
        ],
        "variables" => [
            "type" => "json",
            "file" => "variables.json",
            "default" => "{}",
            "mime-type" => "application/json"
        ],
        "fonts" => [
            "type" => "json",
            "file" => "fonts.json",
            "default" => "[]",
            "mime-type" => "application/json"
        ],
        "scripts" => [
            "type" => "json",
            "file" => "scripts.json",
            "default" => "[]",
            "mime-type" => "application/json"
        ],
        "styles" => [
            "type" => "css",
            "file" => "styles.css",
            "default" => "",
            "mime-type" => "text/css"
        ],
        "javascript" => [
            "type" => "js",
            "file" => "javascript.js",
            "default" => "",
            "mime-type" => "application/javascript"
        ],
    ];

    const ASSET_KEY = "assets";

    /** @var ThemeProviderInterface[] */
    private $themeProviders = [];

    /** @var VariablesProviderInterface[] */
    private $variableProviders = [];


    /**
     * Add a theme-variable provider.
     *
     * @param VariablesProviderInterface $provider
     */
    public function addVariableProvider(VariablesProviderInterface $provider) {
        $this->variableProviders[] = $provider;
    }

    /**
     * Get all configured theme-variable providers.
     *
     * @return array
     */
    public function getVariableProviders(): array {
        return $this->variableProviders;
    }

    /**
     * Set custom theme provider.
     *
     * @param ThemeProviderInterface $provider
     */
    public function addThemeProvider(ThemeProviderInterface $provider) {
        $this->themeProviders[] = $provider;
    }

    /**
     * Get theme with all assets from provider detected
     *
     * @param string|int $themeKey Theme key or id
     * @return array
     */
    public function getThemeWithAssets($themeKey): array {
        $provider = $this->getThemeProvider($themeKey);
        $theme = $provider->getThemeWithAssets($themeKey);
        return $theme;
    }

    /**
     * Create new theme.
     *
     * @param array $body Array of incoming params.
     *        fields: name (required)
     * @return array
     */
    public function postTheme(array $body): array {
        $provider = $this->getThemeProvider('1');
        $theme = $provider->postTheme($body);
        return $theme;
    }

    /**
     * Update theme name by ID.
     *
     * @param int $themeID Theme ID
     * @param array $body Array of incoming params.
     *        fields: name (required)
     * @return array
     */
    public function patchTheme(int $themeID, array $body): array {
        $provider = $this->getThemeProvider($themeID);
        $theme = $provider->patchTheme($themeID, $body);
        return $theme;
    }

    /**
     * Delete theme by ID.
     *
     * @param int $themeID Theme ID
     */
    public function deleteTheme(int $themeID) {
        $provider = $this->getThemeProvider($themeID);
        $provider->deleteTheme($themeID);
    }

    /**
     * Set current theme.
     *
     * @param int $themeID Theme ID to set current.
     * @return array
     */
    public function setCurrentTheme(int $themeID): array {
        $provider = $this->getThemeProvider($themeID);
        return $provider->setCurrent($themeID);
    }

    /**
     * Get current theme.
     *
     * @return array|void If no currnt theme set returns null
     */
    public function getCurrentTheme(): ?array {
        $provider = $this->getThemeProvider(1);
        return $provider->getCurrent();
    }

    /**
     * Set theme asset (update existing or create new if asset does not exist).
     *
     * @param int $themeID The unique theme ID.
     * @param string $assetKey Unique asset key (ex: header.html, footer.html, fonts.json, styles.css)
     * @param string $data Data content for asset to set
     *
     * @return array
     */
    public function setAsset(int $themeID, string $assetKey, string $data): array {
        $provider = $this->getThemeProvider($themeID);
        return $provider->setAsset($themeID, $assetKey, $data);
    }

    /**
     * Sparse theme asset (update existing or create new if asset does not exist).
     *
     * @param int $themeID The unique theme ID.
     * @param string $assetKey Asset key.
     *       Note: variables.json only allowed.
     * @param string $data Data content for asset to set
     *
     * @return array
     */
    public function sparseAsset(int $themeID, string $assetKey, string $data): array {
        $provider = $this->getThemeProvider($themeID);
        return $provider->sparseAsset($themeID, $assetKey, $data);
    }

    /**
     * Get theme provider.
     *
     * @param string|int $themeKey Theme key or id
     * @return ThemeProviderInterface
     * @throws ClientException Throws an exception if no suitable theme provider found.
     */
    private function getThemeProvider($themeKey): ThemeProviderInterface {
        $themeType = (is_int($themeKey) || ctype_digit($themeKey)) ? ThemeProviderInterface::TYPE_DB : ThemeProviderInterface::TYPE_FS;
        foreach ($this->themeProviders as $provider) {
            $provider->setVariableProviders($this->getVariableProviders());
            if ($themeType === $provider->themeKeyType()) {
                return $provider;
            }
        }
        throw new ClientException('No custom theme provider found!', 501);
    }

    /**
     * Get the raw data of an asset.
     *
     * @param string $themeKey
     * @param string $assetKey
     */
    public function getAssetData(string $themeKey, string $assetKey): string {
        $provider = $this->getThemeProvider($themeKey);
        return $provider->getAssetData($themeKey, $assetKey);
    }

    /**
     * DELETE theme asset.
     *
     * @param string $themeKey The unique theme key or ID.
     * @param string $assetKey Unique asset key (ex: header.html, footer.html, fonts.json, styles.css)
     */
    public function deleteAsset(string $themeKey, string $assetKey) {
        $provider = $this->getThemeProvider($themeKey);
        return $provider->deleteAsset($themeKey, $assetKey);
    }
}
