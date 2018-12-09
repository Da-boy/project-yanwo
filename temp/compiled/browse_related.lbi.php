<div id="maybe-like" class="m m2">
  <div class="mt">
    <h2>根据浏览猜你喜欢</h2>
    <div class="extra"></div>
  </div>
  <div class="mc"> <a class="guess-control prev" id="guess-forward">&lt;</a><a class="guess-control next" id="guess-backward">&gt;</a>
    <div id="guess-scroll" style="position: relative; width: 920px; height: 251px; overflow: hidden; ">
      <ul class="lh" style="position:absolute;">
        <?php 
$k = array (
  'name' => 'browse_related',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
      </ul>
    </div>
  </div>
</div>
