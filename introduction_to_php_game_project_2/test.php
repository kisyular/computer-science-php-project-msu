<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/05/27
 * Time: 11:55 PM
 */
class Adder {
    public function __construct($a,$b)
    {
        $this -> a = $a;
        $this -> b = $b;

    }
    public function getSum(){
        return $this->a + $this->b;
    }
    private $a , $b;
}
class Skyscraper {
    public function __construct($sky)
    {
        $this->sky = $sky;
    }
    public function rowCnt($r){
        $row = $this->sky[$r-1];
        $cnt = 0;
        for($i = 0; $i < count($row); $i++){
            if(max(array_slice($row, 0, $i+1, true)) === $row[$i]){
                $cnt++;
            }
        }
        return $cnt;
    }
    public function colCnt($c){
        $column = array();
        foreach($this->sky as $row) {
            $column[] = $row[$c - 1];
        }
        $cnt = 0;
        for($i = 0; $i < count($column); $i++){
            if(max(array_slice($column, 0, $i+1, true)) === $column[$i]){
                $cnt++;
            }
        }
        return $cnt;

    }
    private $sky;
}
$skyscraper = array(array(2, 1, 4, 3),
    array(3, 4, 1, 2),
    array(4, 2, 3, 1),
    array(1, 3, 2, 4));

$s = new Skyscraper($skyscraper);
echo $s->rowCnt(1) . ' ';
echo $s->rowCnt(2) . ' ';
echo $s->rowCnt(3) . ' ';
echo $s->rowCnt(4) . '<br>';
echo $s->colCnt(1) . ' ';
echo $s->colCnt(2) . ' ';
echo $s->colCnt(3) . ' ';
echo $s->colCnt(4) . '<br>';
class DiscountTest extends \PHPUnit_Framework_TestCase{

    public function test(){
        $discount = new Discount();
        $discount->addMember('Bob', 55);
        $discount->addMember('Sue', 54);
        $discount->addMember('Tod', 56);
        $this->assertEquals(3, $discount->numMembers());
        $this->assertEquals(2, $discount->numDiscounts());
    }
}
class FiscalTest extends \PHPUnit_Framework_TestCase{
    public function test(){
        $this->assertEquals("2015", Fiscal::year("2015/2/29"));
        $this->assertEquals("2015", Fiscal::year("2015/2/28"));
        $this->assertEquals("2014", Fiscal::year("2015/2/27"));
        $this->assertEquals("2016", Fiscal::year("2016/2/29"));
        $this->assertEquals("2015", Fiscal::year("2016/2/28"));
        $this->assertEquals("1900", Fiscal::year("1900/2/28"));
        $this->assertEquals("2049", Fiscal::year("2050/2/27"));
        $this->assertEquals("1999", Fiscal::year("2000/2/28"));

    }
}


class Quadratic {
    /** Construct a new Quadratic object
     * @param $a A value
     * @param $b B value
     * @param $c C value */
    public function __construct($a, $b, $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    /** Compute the roots of the quadratic
     * @return array with two roots or null if there are no roots. */
    public function roots() {
        if($this->a == 0) {
            return null;    // Not a quadratic, so no roots
        }

        $rad = $this->b * $this->b - 4 * $this->a * $this->c;
        if($rad < 0) {
            return null;
        }

        return array( (-$this->b - sqrt($rad)) / (2 * $this->a),
            (-$this->b + sqrt($rad)) / (2 * $this->a));
    }

    /** Create HTML paragram with a statement about the roots
     * It will be like The roots of x<sup>2</sup> + 1x - 6 are -3 and 2.
     * or x<sup>2</sup> + 10 has no roots. */
    public function rootsHtml() {
        $roots = $this->roots();		// Compute the roots
        $eq = $this->equationHtml();	// Convert equation to HTML
        if($roots === null) {
            return "<p>$eq has no roots.</p>";
        } else {
            $r1 = round($roots[0], 3);	// Round to 3 decimal places
            $r2 = round($roots[1], 3);
            return "<p>The roots of $eq are $r1 and $r2.</p>";
        }
    }

    /** Create HTML for this equation.
     * This is designed to make the equations look as expected
     * @return HTML */
    private function equationHtml() {
        if($this->a != 0) {
            return $this->equationPart($this->a, true, "x<sup>2</sup>") .
                $this->equationPart($this->b, false, "x") .
                $this->equationPart($this->c, false, "");
        } else if($this->b != 0) {
            return $this->equationPart($this->b, true, "x") .
                $this->equationPart($this->c, false, "");
        } else {
            return $this->c;
        }

    }

    /** Pretty conversion of part of a quadratic equation to HTML
     * @param $n Value to convert
     * @param $first True if first item in quadratic
     * @param $append Part to append (x<sup>2</sup> or x or empty)
     * @return HTML */
    private function equationPart($n, $first, $append) {
        if($first) {
            // Handle first value is 1 or -1
            if($n == 1) {
                // If 1, just return x or x^2
                return $append;
            } else if($n == -1) {
                // If -1, just return -x or -x^2
                return "-$append";
            }

            // Return the number concatenated with x or x^2
            return $n . $append;
        }

        if($n == 0) {
            // If the number is zero and not first, we skip that part
            return "";
        }

        if($n == 1 && $append !== "") {
            // If number is 1 and not the last value, just return x or x^2
            return " + $append";
        } else if($n == -1 && $append !== "") {
            // If number is -1 and not the last value, just return -x or -x^2
            return " - $append";
        }

        if($n < 0) {
            // Negative numbers, space between the - and number
            return " - " . (-$n) . $append;
        } else {
            // Postive number, space between the - and number
            return " + $n$append";
        }
    }

    private $a;		// Polynomial coefficients
    private $b;
    private $c;
}
