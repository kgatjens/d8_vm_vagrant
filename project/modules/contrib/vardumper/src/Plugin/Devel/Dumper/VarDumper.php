<?php

namespace Drupal\vardumper\Plugin\Devel\Dumper;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\devel\Plugin\Devel\Dumper\VarDumper as DevelVarDumper;
use Drupal\vardumper\VarDumper\Dumper\HtmlDrupalDumper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

/**
 * Class VarDumper.
 */
class VarDumper extends DevelVarDumper implements ContainerFactoryPluginInterface {

  /**
   * @var \Drupal\vardumper\VarDumper\Dumper\HtmlDrupalDumper
   */
  protected $dumper;

  /**
   * VarDumper constructor.
   *
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\vardumper\VarDumper\Dumper\HtmlDrupalDumper $dumper
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, HtmlDrupalDumper $dumper) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->dumper = $dumper;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('vardumper_html_drupal_dumper')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function export($input, $name = NULL) {
    $cloner = $this->getVarCloner();
    $dumper = 'cli' === PHP_SAPI ? new CliDumper() : $this->dumper;

    $output = fopen('php://memory', 'r+b');
    $dumper->dump($cloner->cloneVar($input), $output);
    $output = stream_get_contents($output, -1, 0);

    return $this->setSafeMarkup($output);
  }

  /**
   * @return \Symfony\Component\VarDumper\Cloner\VarCloner
   */
  private function getVarCloner() {
    $cloner = new VarCloner();
    $myCasters = [
      'Drupal\Core\Session\UserSession' => 'Drupal\vardumper\Caster\DrupalCaster::castUser',
    ];
    $cloner->addCasters($myCasters);
    return $cloner;
  }

}
