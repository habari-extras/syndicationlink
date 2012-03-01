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
    return $content . "<br/><br/><a href=\"" . Site::get_url( 'habari' ) . 
      "\">" . Utils::htmlspecialchars( Options::get( 'title' ) ) . "</a><br/><br/><br/>";
  }
}
?>
