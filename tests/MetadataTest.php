<?php
  declare(strict_types=1);

  use PHPUnit\Framework\TestCase;
  use Symfony\Component\Yaml\Yaml;

  final class MetadataTest extends TestCase {

    public function testMetaExists() {
      $this->assertFileExists('meta.yml', 'Metadata file not found!');
    }

    public function testReadingFile() {
      $this->assertIsReadable('meta.yml', 'Metadata file not readable!');
    }

    public function testFetchYAML() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('array', $pp, 'Metadata file parsed incorrectly!');
    }

    public function testThereIsName() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('string', $pp['name'], 'The Name did not match the required type (string)!');
    }

    public function testThereIsDescription() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('string', $pp['description'], 'The Description did not match the required type (string)!');
    }

    public function testThereIsVersion() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('string', $pp['version'], 'The Version did not match the required type (string)!');
    }

    public function testThereIsLink() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('string', $pp['link'], 'The Link did not match the required type (string)!');
    }

    public function testThereIsLicense() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('array', $pp['license'], 'The License did not match the required type (array)!');
    }

    public function testThereIsLicenseCode() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('string', $pp['license']['code'], 'The Code did not match the required type (string)!');
    }

    public function testThereIsLicenseName() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('string', $pp['license']['name'], 'The Name did not match the required type (string)!');
    }

    public function testThereIsLicenseLink() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('string', $pp['license']['link'], 'The Link did not match the required type (string)!');
    }

    public function testThereIsAuthor() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('array', $pp['author'], 'The Author did not match the required type (array)!');
    }

    public function testThereIsAuthorName() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('string', $pp['author']['name'], 'The Name did not match the required type (string)!');
    }

    public function testThereIsAuthorEmail() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('string', $pp['author']['email'], 'The Email did not match the required type (string)!');
    }

    public function testThereIsAuthorLink() {
      $pp = Yaml::parseFile('meta.yml');
      $this->assertInternalType('string', $pp['author']['link'], 'The Link did not match the required type (string)!');
    }

  }
?>
