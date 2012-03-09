<?php
/**
 * Add a link back to site root to ensure that 
 * even hijacked posts have site URL in the actual content.
 *
 *
 */
class SyndicationLink 
extends Plugin
{	
  public function filter_atom_add_post($content, $post )
  {
    $cCount = Options::get('syndicationLink__truncateAfter');

    if ($cCount == 0)
      return $content . "<br/><br/><a href=\"" . Site::get_url( 'habari' ) . "\">" . 
	Utils::htmlspecialchars( Options::get( 'title' ) ) . "</a><br/><br/><br/>";
    else
      return self::truncate_article($content, (int) $cCount, $post->permalink);
  }

  /* 
   * truncate an article after about some number of characters
   * and provide link back directly to truncated article.
   */
  function truncate_article($textIn, $characterCount, $link) 
  {
    if(strlen($textIn) > $CharacterCount) 
      {
   	$textIn = substr($textIn, 0, $characterCount);
   	$textIn .= $textIn . " . . . <br/><br/><a href=\"" . $link . "\">" . 
   	"Complete article</a><br/><br/><br/>";
      }
    return $textIn;

  }

  /*
   * Request number of characters after which to truncate articles in syndication
   * Zero, or undefined means 'do not truncate'.
   */
  public function configure()
  {
    $ui = new FormUI( 'syndicationLink_form' );
    $ui->append( 'text', 'truncateAfter', 'option:syndicationLink__truncateAfter',
		 _t('Truncate after a number of characters, zero means display all:', 'plugin_locale') );
    $ui->append('submit', 'save', _t('Save', 'plugin_locale'));
    return $ui;
  }
}
?>
