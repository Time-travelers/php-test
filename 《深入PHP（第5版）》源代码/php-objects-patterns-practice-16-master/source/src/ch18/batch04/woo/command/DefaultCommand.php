<?php
namespace popp\ch18\batch04\woo\command;

use popp\ch18\batch04\woo\controller\Request;

class DefaultCommand extends Command
{
    public function doExecute(Request $request)
    {
        $request->addFeedback("Welcome to WOO");
    }
}
