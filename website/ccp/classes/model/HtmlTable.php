<?php
declare(strict_types = 1);
namespace ccp\classes\model;
class HtmlTable extends HtmlBase {
  public static string $ID_TABLE_DATA = "dataTbl";
  /*
   * $query is sql query
   * $mode is page mode
   * $classNames is style class names (default is NULL)
   * $caption is additional info about table (default is NULL)
   * $colFormats is delimited string of column formats (default is NULL)
   * $hiddenId is name prefix of field to store row identifier (default is NULL)
   * $selectedColumnVals is delimited string of selected rows (default is "")
   * $delimiter is delimiter (default is ", ")
   * $foreignKeys is delimited string of foreign key queries (default is NULL)
   * $html is array of arrays (array of html to insert, array of column header values, array of result indexes, array of array of status name/button text value, array of result indexes) (default is NULL)
   * $headerRow is whether to display header row or not (default is true)
   * $showNote is true to display sorting note, false to hide (default is true)
   * $hiddenAdditional is array of name and index of value to store (default is NULL)
   * $hideColIndexes is array of column indexes to hide that are returned from query (default is NULL)
   * $colSpan is array of arrays (array of names, array of columns to colspan, array of array of columns to ignore) (default is NULL)
   * $tableIdSuffix is suffix of table id (default is NULL)
   * $width is width of table (default is 100%)
   * $link is array of arrays (array of index, array of values to build link either string literal or query index (page, mode, id, name) (default is NULL)
   */
//    private string $query; // query
//    private array|null $class; // array of class names
//    private string|null $caption; // additional info about table
//    private array|null $columnFormat; // array of column formats
//    private string|null $hiddenId; // name prefix of field to store row identifier
//    private string|null $selectedRow; // array of selected rows
//    private string $delimiter; // delimiter (default is ", ")
//    private array|null $foreignKeys; // array of foreign key queries
//    private array|null $html; // array of arrays (array of html to insert, array of column header values, array of result indexes, array of array of status name/button text value, array of result indexes)
//    private bool $header; // boolean to display header row or not
//    private bool $note; // boolean true to display sorting note, false to hide
//    private array|null $hiddenAdditional; // array of name and index of value to store
//    private array|null $hideColumnIndexes; // array of column indexes to hide that are returned from query
//    private array|null $colspan; // array of arrays (array of names, array of columns to colspan, array of array of columns to ignore)
//    private string|null $suffix; // suffix of table id
//    private string $width; // width of table
//    private array|null $link; // array of arrays (array of index, array of values to build link either string literal or query index (page, mode, id, name)
  public function __construct(protected string|null $caption, protected array|null $class, protected array|null $colspan, protected array|null $columnFormat, protected bool $debug, protected string $delimiter, protected array|null $foreignKeys, protected bool $header, protected array|null $hiddenAdditional, protected string|null $hiddenId, protected array|null $hideColumnIndexes, protected array|null $html, protected string|int|null $id, protected array|null $link, protected bool $note, protected string $query, protected string|null $selectedRow, protected string|null $suffix, protected string $width) {
    parent::__construct(null, $class, $debug, $id, - 1, null);
  }
  public function getCaption() {
    return $this->caption;
  }

  public function getColspan() {
    return $this->colspan;
  }

  public function getColumnFormat() {
    return $this->columnFormat;
  }

  public function getDelimiter() {
    return $this->delimiter;
  }

  public function getForeignKeys() {
    return $this->foreignKeys;
  }

  public function getHtml() {
    $output = "";
//     if (!isset($this->caption)) {
      // $caption = "<strong>Hold shift and click on additional column(s) to do multi column sort</strong>";
//     }
    $hasRecords = false;
    $databaseResult = new DatabaseResult($this->isDebug());
    $result = $databaseResult->getConnection()->query($this->query);
    if ($result) {
      $numRecords = $result->rowCount();
      $hasRecords = 0 < $numRecords;
    }
    if ($hasRecords) {
      $firstRow = true;
//       $ctr = 1;
      $ary = NULL;
      if ("" != $this->selectedRow) {
        $ary = explode($this->delimiter, $this->selectedRow);
      }
      // set width using style to override default from css
      $output .=
        "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"display" . (null !== $this->getClassAsString() ? " " . $this->getClassAsString() : "") . "\" id=\"" . self::$ID_TABLE_DATA . (isset($this->suffix) ? $this->suffix : "") . "\" style=\"width: " . $this->width . ";\">\n";
      if (isset($this->caption)) {
        $output .= "<caption>" . $this->caption . "</caption>";
      }
      $count = $result->columnCount();
      if (isset($this->colspan)) {
        $colSpanIgnoreAllIndexes = array();
        foreach ($this->colspan[2] as $ary) {
          $colSpanIgnoreAllIndexes = array_merge($ary, $colSpanIgnoreAllIndexes);
        }
        $colSpanAllIndexes = array_merge($this->colspan[1], $colSpanIgnoreAllIndexes);
      }
      while ($row = $result->fetch()) {
        if ($this->header && $firstRow) {
          $output .= "     <thead>\n";
          if (isset($this->colspan)) {
            $output .= "      <tr>\n";
            $colSpanIndex = 0;
            for ($index = 0; $index < $count; $index ++) {
              if ((! isset($this->hideColumnIndexes) || (isset($this->hideColumnIndexes) && FALSE === array_search($index, $this->hideColumnIndexes))) && (! isset($colSpanIgnoreAllIndexes) || (isset($colSpanIgnoreAllIndexes) && FALSE === array_search($index, $colSpanIgnoreAllIndexes)))) {
                $output .= "       <th colspan=\"";
                // if not found in col span indexes
                if (isset($this->colspan[1]) && FALSE === array_search($index, $this->colspan[1])) {
                  $output .= "1";
//                   $thStyle = " style=\"border-right: 1px solid black;\"";
                } else {
                  $output .= count($this->colspan[2][$colSpanIndex]) + 1;
                  $colSpanIndex++;
//                   $thStyle = " style=\"border-right: 1px solid black;\"";
                }
                $output .= "\" rowspan=\"";
                // if not found in col span indexes
                if (isset($this->colspan[1]) && FALSE === array_search($index, $this->colspan[1])) {
                  $output .= "2";
                } else {
                  $output .= "1";
                }
                $output .= "\"" . (isset($thStyle) ? $thStyle : "") . ">";
                // if found in col span indexes
                if (isset($this->colspan[1]) && FALSE !== array_search($index, $this->colspan[1])) {
                  $output .= $this->colspan[0][array_search($index, $this->colspan[1])];
                  // if not found in col span indexes
                } else if (!isset($colSpanAllIndexes) || (isset($colSpanAllIndexes) && FALSE === array_search($index, $colSpanAllIndexes))) {
                  $output .= ucwords($result->getColumnMeta($index)["name"]);
                }
                $output .= "</th>\n";
              }
            }
            $output .= "      </tr>\n";
          }
          $output .= "      <tr>\n";
          for ($index = 0; $index < $count; $index ++) {
            if (!isset($this->hideColumnIndexes) || (isset($this->hideColumnIndexes) && FALSE === array_search($index, $this->hideColumnIndexes))) {
              // if found in all col span indexes
              if (!isset($colSpanAllIndexes) || (isset($colSpanAllIndexes) && FALSE !== array_search($index, $colSpanAllIndexes))) {
                $output .= "       <th colspan=\"1\" rowspan=\"1\">" . ucwords($result->getColumnMeta($index)["name"]) . "</th>\n";
              }
            }
          }
          if (isset($this->html)) {
            for ($idx = 0; $idx < count($this->html[1]); $idx ++) {
              $output .= "     <th colspan=\"1\" rowspan=\"1\">" . $this->html[1][$idx] . "</th>\n";
            }
          }
          if (isset($this->hiddenAdditional)) {
            $output .= "<th></th>\n";
          }
          $output .= "      </tr>\n";
          $output .= "     </thead>\n";
          $output .= "     <tbody>\n";
        }
        $firstRow = false;
        $output .= "      <tr>\n";
        $linkCounter = 0;
        for ($index = 0; $index < $count; $index ++) {
          if (!isset($this->hideColumnIndexes) || (isset($this->hideColumnIndexes) && FALSE === array_search($index, $this->hideColumnIndexes))) {
            $output .= "       <td";
            $formattedFlag = false;
            $class = array();
            $temp = $row[$index];
            if (! $formattedFlag) {
              $aryFmt = $result->getColumnMeta($index);
              if (isset($this->columnFormat)) {
                $aryFmt2 = array();
                for ($idx = 0; $idx < count($this->columnFormat); $idx ++) {
                  if ($this->columnFormat[$idx][0] == $index) {
                    $fmt = $this->columnFormat[$idx][1];
                    $aryFmt2 = explode(",", $fmt);
                    $places = $this->columnFormat[$idx][2];
                    break;
                  }
                }
                if (count($aryFmt2) == 0) {
                  $aryFmt = array($aryFmt["native_type"]);
                } else {
                  $aryFmt = $aryFmt2;
                }
              } else {
                $aryFmt = array($aryFmt["native_type"]);
              }
              foreach ($aryFmt as $fmt) {
                switch (strtolower($fmt)) {
                  case "date":
                    $dateTime = new DateTime($this->isDebug(), null, $temp);
                    $temp = $dateTime->getDisplayFormat();
                    break;
                  case "datetime":
                    $dateTime = new DateTime($this->isDebug(), null, $temp);
                    $temp = $dateTime->getDisplayTimeFormat();
                    break;
                  case "time":
                    $dateTime = new DateTime($this->isDebug(), null, $temp);
                    $temp = $dateTime->getDisplayAmPmFormat();
                    array_push($class, "time");
                    break;
                  case "currency":
                  case "percentage":
                  case "number":
//                     $class .= " number";
//                     if ($fmt != "percentage") {
                    if ($fmt != "number") {
                      array_push($class, "number");
                    }
                    $prefix = "";
                    $suffix = "";
                    if ("currency" == $fmt) {
                      $prefix = Constant::$SYMBOL_CURRENCY_DEFAULT;
                      // $formatter = new NumberFormatter("en-US", NumberFormatter::CURRENCY);
                      // $symbol = $formatter->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
                      // $temp = $formatter->formatCurrency($temp, $symbol);
                    } else if ("percentage" == $fmt) {
                      $suffix = Constant::$SYMBOL_PERCENTAGE_DEFAULT;
                      $temp *= 100;
                      // $formatter = new NumberFormatter("en-US", NumberFormatter::PERCENT);
                      // $symbol = $formatter->getSymbol(NumberFormatter::PERCENT_SYMBOL);
                      // $temp = $formatter->formatCurrency($temp, $symbol);
                    }
                    if (isset($temp) && isset($places) && -1 != $places) {
                      $temp = number_format((float) $temp, $places);
                    }
                    if ($temp != "") {
                      $temp = $prefix . $temp . $suffix;
                    }
                    break;
                  case "string":
                    switch ($temp) {
                      case Constant::$FLAG_YES:
                        $temp = Constant::$TEXT_YES;
                        break;
                      case Constant::$FLAG_NO:
                        $temp = Constant::$TEXT_NO;
                        break;
                    }
                    break;
                  case "left":
                  case "positive":
                  case "negative":
                  case "center":
                  case "right":
                    array_push($class, $fmt);
                    break;
                }
              }
              if (!in_array("negative", $class) && !in_array("positive", $class) && isset($temp)) {
                if (0 != preg_match('/^\$-+\d+(,\d+)?(.\d+)?|-+\d+(,\d+)?(.\d+)?%$/', $temp)) {
                  array_push($class, "negative");
                } else if (0 != preg_match('/^\$\d+(,\d+)?(.\d+)?|\d+(,\d+)?(.\d+)?%$/', $temp)) {
                  array_push($class, "positive");
                }
              }
            }
            $output .= ($class == "" || count($class) == 0 ? "" : " class=\"" . implode(" ", $class) . "\"");
            $output .= ">";
            if ($result->getColumnMeta($index)["name"] == "map" && $temp != "") {
              $output .= "<a href=\"" . $temp . "\">View</a>";
//             } elseif (isset($this->link) && in_array($index, $this->link[0])) {
//               $link = new HtmlLink(null, null, $this->isDebug(), $this->link[1][0], null, $this->link[1][1], array($row[$this->link[1][2]], $this->link[1][3]), -1, $row[$this->link[1][4]], null);
            } elseif (isset($this->link) && in_array($index, $this->link[0])) {
              $link = new HtmlLink(null, null, $this->isDebug(), $this->link[$linkCounter + 1][0], null, $this->link[$linkCounter + 1][1], array($row[$this->link[$linkCounter + 1][2]], $this->link[1][3]), -1, $row[$this->link[$linkCounter + 1][4]], null);
              $output .= $link->getHtml();
              $linkCounter++;
            } else {
              $output .= isset($temp) ? htmlentities($temp, ENT_NOQUOTES, "UTF-8") : "";
            }
            $output .= "</td>\n";
          }
        }
        if (isset($this->html)) {
          // 0 is html, 1 is headers, 2 is index, 3 is status name/button text, 4 is player index
          for ($idx = 0; $idx < count($this->html[0]); $idx ++) {
            if (is_string($this->html[2][$idx])) {
              $bountyPaid = $this->html[3][1][0];
              $queryNested = $this->html[2][$idx];
              $queryNested = str_replace("?2", $row[$this->html[4][0]], $queryNested);
              $databaseResult = new DatabaseResult($this->isDebug());
              $resultNested = $databaseResult->getConnection()->query($queryNested);
              // existence of record means bounty is paid
              if ($resultNested && 0 < $resultNested->rowCount()) {
                // if record exists set to not paid
                $bountyPaid = $this->html[3][0][0];
                $resultNested->closeCursor();
              }
              for ($idx2 = 0; $idx2 < count($this->html[0]); $idx2 ++) {
                if ($bountyPaid == $this->html[3][$idx2][0]) {
                  $temp = $this->html[3][$idx2][1];
                  break;
                }
              }
            } else {
              for ($idx2 = 0; $idx2 < count($this->html[0]); $idx2 ++) {
                if ($row[$this->html[2][$idx]] == $this->html[3][$idx2][0]) {
                  $temp = $this->html[3][$idx2][1];
                  break;
                }
              }
            }
            // opposite status since based on buttons (need to change)
            if ($temp == "Not paid") {
              $temp = "checked";
            } else {
              $temp = "";
            }
            $htmlTemp = str_replace("value=\"?1\"", $temp, $this->html[0][$idx]); // button text
            $htmlTemp = str_replace("?2", $row[$this->html[4][0]], $htmlTemp); // player id
            $htmlTemp = str_replace("?3", $temp, $htmlTemp); // status name
            $htmlTemp = str_replace("?4", $row[$this->html[4][1]], $htmlTemp); // rebuy count
            $output .= "     <td align=\"center\">" . $htmlTemp . "</td>\n";
          }
        }
        if (isset($this->hiddenId)) {
            $output .= "<td>\n";
            $hiddenTemp = new FormControl($this->isDebug(), null, null, false, null, array("hide"), null, false, $this->hiddenId . "_" . $row[0], null, $this->hiddenId . "_" . $row[0], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $row[0], null);
            $output .= $hiddenTemp->getHtml();
            $output .= "</td>\n";
        }
        if (isset($this->hiddenAdditional)) {
          for ($index = 0; $index < count($this->hiddenAdditional); $index ++) {
            $output .= "<td>\n";
            $hiddenTemp = new FormControl($this->isDebug(), null, null, false, null, array("hide"), null, false, $this->hiddenAdditional[$index][0] . "_" . $row[$this->hiddenAdditional[$index][1]], null, $this->hiddenAdditional[$index][0] . "_" . $row[$this->hiddenAdditional[$index][1]], null, null, false, null, null, null, null, FormControl::$TYPE_INPUT_HIDDEN, $row[$this->hiddenAdditional[$index][1]], null);
            $output .= $hiddenTemp->getHtml();
            $output .= "</td>\n";
          }
        }
        $output .= "     </tr>\n";
      }
      $output .= "     </tbody>\n";
      $output .= "    </table>\n";
      $result->closeCursor();
    } else {
      $output .= "<br>No data found";
    }
    return $output;
  }

  public function getHiddenAdditional() {
    return $this->hiddenAdditional;
  }

  public function getHiddenId() {
    return $this->hiddenId;
  }

  public function getHideColumnIndexes() {
    return $this->hideColumnIndexes;
  }

  public function getLink() {
    return $this->link;
  }

  public function getQuery() {
    return $this->query;
  }

  public function getSelectedRow() {
    return $this->selectedRow;
  }

  public function getSuffix() {
    return $this->suffix;
  }

  public function getWidth() {
    return $this->width;
  }

  public function isHeader() {
    return $this->header;
  }

  public function isNote() {
    return $this->note;
  }

  public function setCaption(string $caption) {
    $this->caption = $caption;
  }

  public function setColspan(array $colspan) {
    $this->colspan = $colspan;
  }

  public function setColumnFormat(array $columnFormat) {
    $this->columnFormat = $columnFormat;
  }

  public function setDelimiter(string $delimiter) {
    $this->delimiter = $delimiter;
  }

  public function setForeignKeys(array $foreignKeys) {
    $this->foreignKeys = $foreignKeys;
  }

  public function setHiddenId(string $hiddenId) {
    $this->hiddenId = $hiddenId;
  }

  public function setHeader(bool $header) {
    $this->header = $header;
  }

  public function setHiddenAdditional(array $hiddenAdditional) {
    $this->hiddenAdditional = $hiddenAdditional;
  }

  public function setHideColumnIndexes(array $hideColumnIndexes) {
    $this->hideColumnIndexes = $hideColumnIndexes;
  }

  public function setHtml(array $html) {
    $this->html = $html;
  }

  public function setLink(array $link) {
      $this->link = $link;
  }

  public function setNote(bool $note) {
      $this->note = $note;
  }

  public function setQuery(string $query) {
    $this->query = $query;
  }

  public function setSelectedRow(array $selectedRow) {
    $this->selectedRow = $selectedRow;
  }

  public function setSuffix(string $suffix) {
      $this->suffix = $suffix;
  }

  public function setWidth(string $width) {
      $this->width = $width;
  }

  public function __toString() {
    $output = parent::__toString();
    $output .= ", caption = '";
    $output .= $this->caption;
    $output .= "', colspan = ";
    $output .= print_r($this->colspan, true);
    $output .= ", columnFormat = ";
    $output .= print_r($this->columnFormat, true);
    $output .= ", delimiter = '";
    $output .= $this->delimiter;
    $output .= "', foreignKeys = ";
    $output .= print_r($this->foreignKeys, true);
    $output .= ", header = "; // boolean
    $output .= var_export($this->header, true);
    $output .= ", hiddenAdditional = ";
    $output .= print_r($this->hiddenAdditional, true);
    $output .= ", hiddenId = '"; // not array
    $output .= $this->hiddenId;
    $output .= "', hideColumnIndexes = ";
    $output .= print_r($this->hideColumnIndexes, true);
    $output .= ", html = ";
    $output .= print_r($this->html, true);
    $output .= ", link = ";
    $output .= print_r($this->link, true);
    $output .= ", note = ";
    $output .= var_export($this->note, true);
    $output .= ", query = '";
    $output .= $this->query;
    $output .= "', selectedRow = ";
    $output .= print_r($this->selectedRow, true);
    $output .= ", suffix = '";
    $output .= $this->suffix;
    $output .= "', width = '";
    $output .= $this->width;
    $output .= "'";
    return $output;
  }
}