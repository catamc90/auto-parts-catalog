#!/usr/bin/env bash

tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src/ --rules=@Symfony,\
heredoc_to_nowdoc,\
phpdoc_add_missing_param_annotation,\
phpdoc_order,\
doctrine_annotation_braces,\
doctrine_annotation_spaces,\
doctrine_annotation_indentation,\
linebreak_after_opening_tag,\
no_useless_else,\
no_useless_return,\
ordered_imports,\
phpdoc_order,\
elseif,\
ereg_to_preg,\
function_declaration,\
function_typehint_space,\
mb_str_functions,\
native_function_invocation\
 --allow-risky=yes\
 --show-progress=dots



#tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src