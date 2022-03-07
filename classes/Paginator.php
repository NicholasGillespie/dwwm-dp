<?php

class Paginator
{
  public $limit;
  public $offset;

  public $previous;
  public $next;

  public $page;
  public $total_pages;

  public function __construct($page, $records_per_page, $total_articles)
  {
    $this->limit = $records_per_page;

    // validate int = filter_var -> FILTER_VALIDATE_INT (default, min_range, max_range)
    $options = ['options' => ['default' => 1, 'min_range' => 1]];
    $this->page = $page = filter_var($page, FILTER_VALIDATE_INT, $options);

    if ($page > 1) {
      $this->previous = $page - 1;
    }

    $this->total_pages = $total_pages = ceil($total_articles / $records_per_page);

    if ($page < $total_pages) {
      $this->next = $page + 1;
    }

    $this->offset = $records_per_page * ($page - 1);
  }
}
