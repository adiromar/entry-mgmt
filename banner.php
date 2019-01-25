<!--        <?php //the_content(); 
        $show_after_p = 0;
$content = apply_filters('the_content', $post->post_content);
if(substr_count($content, '<p>') > $show_after_p)
{
  $contents = explode("</p>", $content);
  $p_count = 0;
  foreach($contents as $content)
  {
    echo $content;
    if($p_count == 1)
    {
    ?>
      <?php dynamic_sidebar('Middle of Post'); ?>
    <?php
    }
    echo "</p>";

    if($p_count == 4)
    {
    ?>
      <?php dynamic_sidebar('Midbar'); ?>
    <?php
    }

     if($p_count == 7)
    {
    ?>
      <?php dynamic_sidebar('Middle of Post-2'); ?>
    <?php
    }

    $p_count++;
  }
}
?> -->