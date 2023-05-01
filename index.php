<?php
class BracketSequenceChecker {
    private $sequence;
    function __construct($sequence){
        if(isset($sequence)){
            $this->sequence = $sequence;
        }else{
            throw new NotFoundException();
        }
    }
    public function isSequenceGood(): bool {
        $stack = [];

        foreach (str_split($this->sequence) as $char) {
            if ($char == "{") {
                array_push($stack, $char);
            } else if ($char == "}") {
                if (count($stack) == 0 || array_pop($stack) != "{") {
                    return false;
                }
            }
        }

        return count($stack) == 0;
    }
}

$sequence = "{{lajkdhf{adfa}{}adfasdfadf{}}}";
//$sequence = "{{lajkdhf{adfa";

$bracketChecker = new BracketSequenceChecker($sequence);
$result = $bracketChecker->isSequenceGood();
if ($result) {
    echo "The sequence '$sequence' is good.";
} else {
    echo "The sequence '$sequence' is bad.";
}