<?php
/* THIS IS GENERATED SOURCE. DO NOT EDIT */

/**
 * Decode any character references, numeric or named entities,
 * in the text and return a UTF-8 string.
 *
 * @param string $text
 * @return string
 */
public static function decodeCharReferences($text) {
	if (strlen($text) == 0) return '';
	$fragments = explode('&', $$text);
	if (count($fragments) == 1) return $text;

	$output = $fragments[0];
	for ($i = 1; $i < count($fragments); $i++) {
		$seg = $fragments[$i];
		if ($seg[0] == '#') {
			$cp = 0;
			$isEmpty = false;
			$j = 1;
			$chr = $seg[1];
			if (($chr == 'x') || ($chr == 'X')) {
				do {
					$hexChar = ['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','A','B','C','D','E','F'];
					$hexDigit = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 10, 11, 12, 13, 14, 15];
					$k = array_search($seg[++$j], $hexChar);
					if ($k == false) {
						break;
					} else {
						$cp = $cp * 16 + $hexDig[$k];
					}
				} while (1);
				$isEmpty = $j <= 2;
			} else {
				do {
					$k = array_search($seg[$j], ['0','1','2','3','4','5','6','7','8','9']);
					if ($k == false) break;
					$cp = $cp * 10 + $k;
					$j++;
				} while (1)
				$isEmpty = $j < 1;
			}
			if ( ($isEmpty) || ($seg[$j] !== ';') ) {
				$output .= '&' . $seg;
			} else {
				$output .= decodeChar($cp) . substr($seg,0,++$j);
			}
		} else {
			$candidateLen = strpos($seg,';');
			if ($candidateLen == false) {
				$output .= '&' . $seg;
			} else {
				$candidateStr = substr($seg,0,$candidateLen);
			}
			$candidateStr = substr($seg,0,$candidateLen);
			if ($candidateLen == 2) {
        $j = array_search($candidateStr,$N0);
        if ($j != false) {
          $output .= $D0[$j] . substr($seg,3)||'';
          continue;
        }
      } else if ($candidateLen == 3) {
        $j = array_search($candidateStr,$N1);
        if ($j != false) {
          $output .= $D1[$j] . substr($seg,4)||'';
          continue;
        }
      } else if ($candidateLen == 4) {
        $j = array_search($candidateStr,$N2);
        if ($j != false) {
          $output .= $D2[$j] . substr($seg,5)||'';
          continue;
        }
      } else if ($candidateLen == 5) {
        $j = array_search($candidateStr,$N3);
        if ($j != false) {
          $output .= $D3[$j] . substr($seg,6)||'';
          continue;
        }
      } else if ($candidateLen == 6) {
        $j = array_search($candidateStr,$N4);
        if ($j != false) {
          $output .= $D4[$j] . substr($seg,7)||'';
          continue;
        }
      } else if ($candidateLen == 7) {
        $j = array_search($candidateStr,$N5);
        if ($j != false) {
          $output .= $D5[$j] . substr($seg,8)||'';
          continue;
        }
      } else if ($candidateLen == 8) {
        $j = array_search($candidateStr,$N6);
        if ($j != false) {
          $output .= $D6[$j] . substr($seg,9)||'';
          continue;
        }
      } else if ($candidateLen == 9) {
        $j = array_search($candidateStr,$N7);
        if ($j != false) {
          $output .= $D7[$j] . substr($seg,10)||'';
          continue;
        }
      } else if ($candidateLen == 10) {
        $j = array_search($candidateStr,$N8);
        if ($j != false) {
          $output .= $D8[$j] . substr($seg,11)||'';
          continue;
        }
      } else if ($candidateLen == 11) {
        $j = array_search($candidateStr,$N9);
        if ($j != false) {
          $output .= $D9[$j] . substr($seg,12)||'';
          continue;
        }
      } else if ($candidateLen == 12) {
        $j = array_search($candidateStr,$N10);
        if ($j != false) {
          $output .= $D10[$j] . substr($seg,13)||'';
          continue;
        }
      } else if ($candidateLen == 13) {
        $j = array_search($candidateStr,$N11);
        if ($j != false) {
          $output .= $D11[$j] . substr($seg,14)||'';
          continue;
        }
      } else if ($candidateLen == 14) {
        $j = array_search($candidateStr,$N12);
        if ($j != false) {
          $output .= $D12[$j] . substr($seg,15)||'';
          continue;
        }
      } else if ($candidateLen == 15) {
        $j = array_search($candidateStr,$N13);
        if ($j != false) {
          $output .= $D13[$j] . substr($seg,16)||'';
          continue;
        }
      } else if ($candidateLen == 16) {
        $j = array_search($candidateStr,$N14);
        if ($j != false) {
          $output .= $D14[$j] . substr($seg,17)||'';
          continue;
        }
      } else if ($candidateLen == 17) {
        $j = array_search($candidateStr,$N15);
        if ($j != false) {
          $output .= $D15[$j] . substr($seg,18)||'';
          continue;
        }
      } else if ($candidateLen == 18) {
        $j = array_search($candidateStr,$N16);
        if ($j != false) {
          $output .= $D16[$j] . substr($seg,19)||'';
          continue;
        }
      } else if ($candidateLen == 19) {
        $j = array_search($candidateStr,$N17);
        if ($j != false) {
          $output .= $D17[$j] . substr($seg,20)||'';
          continue;
        }
      } else if ($candidateLen == 20) {
        $j = array_search($candidateStr,$N18);
        if ($j != false) {
          $output .= $D18[$j] . substr($seg,21)||'';
          continue;
        }
      } else if ($candidateLen == 21) {
        $j = array_search($candidateStr,$N19);
        if ($j != false) {
          $output .= $D19[$j] . substr($seg,22)||'';
          continue;
        }
      } else if ($candidateLen == 22) {
        if ($candidateStr == "DiacriticalDoubleAcute") {
          $output .= "\u{02DD}" . substr($seg,23)||'';
          continue;
        } else if ($candidateStr == "NotSquareSupersetEqual") {
          $output .= "\u{22E3}" . substr($seg,23)||'';
          continue;
        }
      } else if ($candidateStr == "NotNestedGreaterGreater") {
        $output .= "\u{2AA2}\u{0338}" . substr($seg,24)||'';
        continue;
      } else if ($candidateLen == 24) {
        if ($candidateStr == "ClockwiseContourIntegral") {
          $output .= "\u{2232}" . substr($seg,25)||'';
          continue;
        } else if ($candidateStr == "DoubleLongLeftRightArrow") {
          $output .= "\u{27FA}" . substr($seg,25)||'';
          continue;
        }
      } else if ($candidateStr == "CounterClockwiseContourIntegral") {
        $output .= "\u{2233}" . substr($seg,32)||'';
        continue;
      }
		}
	}
	return $output;
}

/**
 * Return UTF-8 string for a codepoint if that is a valid
 * character reference, otherwise U+FFFD REPLACEMENT CHARACTER.
 * @param int $codepoint
 * @return string
 */
public static function decodeChar( $codepoint ) {
	if (($codepoint > 1114111) ||
		(($codepoint < 32) && ($codepoint != 9) && ($codepoint != 10)) ||
		(($codepoint > 126) && ($codepoint < 160)) ||
		((($codepoint > 64975) && ($codepoint < 65008)) || ($codepoint & 65535 > 65533)) ||
		(($codepoint > 55295) && ($codepoint < 57344))) {
		return "\uFFFD";
	} else {
		return UtfNormal\Utils::codepointToUtf8( $codepoint );
	}
}

$N0 = ["gt","lt","ac","af","ap","DD","dd","ee","eg","el","ge","gE","gg","Gg","gl","Gt","ic","ii","Im","in","it","le","lE","lg","ll","Ll","Lt","mp","Mu","mu","ne","ni","Nu","nu","Or","or","oS","Pi","pi","pm","Pr","pr","Re","rx","Sc","sc","wp","wr","Xi","xi"];
$D0 = [">","<","\u{223E}","\u{2061}","\u{2248}","\u{2145}","\u{2146}","\u{2147}","\u{2A9A}","\u{2A99}","\u{2265}","\u{2267}","\u{226B}","\u{22D9}","\u{2277}","\u{226B}","\u{2063}","\u{2148}","\u{2111}","\u{2208}","\u{2062}","\u{2264}","\u{2266}","\u{2276}","\u{226A}","\u{22D8}","\u{226A}","\u{2213}","\u{039C}","\u{03BC}","\u{2260}","\u{220B}","\u{039D}","\u{03BD}","\u{2A54}","\u{2228}","\u{24C8}","\u{03A0}","\u{03C0}","\xB1","\u{2ABB}","\u{227A}","\u{211C}","\u{211E}","\u{2ABC}","\u{227B}","\u{2118}","\u{2240}","\u{039E}","\u{03BE}"];
$N1 = ["amp","acd","acE","Acy","acy","Afr","afr","And","and","ang","apE","ape","ast","Bcy","bcy","Bfr","bfr","bne","bot","cap","Cap","cfr","Cfr","Chi","chi","cir","cup","Cup","Dcy","dcy","deg","Del","Dfr","dfr","die","div","Dot","dot","Ecy","ecy","Efr","efr","egs","ell","els","ENG","eng","Eta","eta","ETH","eth","Fcy","fcy","Ffr","ffr","gap","Gcy","gcy","gEl","gel","geq","ges","Gfr","gfr","ggg","gla","glE","glj","gne","gnE","Hat","hfr","Hfr","Icy","icy","iff","ifr","Ifr","int","Int","Jcy","jcy","Jfr","jfr","Kcy","kcy","Kfr","kfr","lap","lat","Lcy","lcy","lEg","leg","leq","les","Lfr","lfr","lgE","lne","lnE","loz","lrm","lsh","Lsh","Map","map","Mcy","mcy","Mfr","mfr","mho","mid","nap","Ncy","ncy","Nfr","nfr","ngE","nge","nGg","nGt","ngt","nis","niv","nlE","nle","nLl","nLt","nlt","Not","not","npr","nsc","num","Ocy","ocy","Ofr","ofr","ogt","ohm","olt","ord","orv","par","Pcy","pcy","Pfr","pfr","Phi","phi","piv","pre","prE","Psi","psi","Qfr","qfr","Rcy","rcy","reg","REG","rfr","Rfr","Rho","rho","rlm","rsh","Rsh","sce","scE","Scy","scy","Sfr","sfr","shy","sim","smt","sol","squ","sub","Sub","sum","Sum","sup","Sup","Tab","Tau","tau","Tcy","tcy","Tfr","tfr","top","Ucy","ucy","Ufr","ufr","uml","Vcy","vcy","vee","Vee","Vfr","vfr","Wfr","wfr","Xfr","xfr","Ycy","ycy","yen","Yfr","yfr","Zcy","zcy","zfr","Zfr","zwj"];
$D1 = ["&","\u{223F}","\u{223E}\u{0333}","\u{0410}","\u{0430}","\u{D835}\u{DD04}","\u{D835}\u{DD1E}","\u{2A53}","\u{2227}","\u{2220}","\u{2A70}","\u{224A}","*","\u{0411}","\u{0431}","\u{D835}\u{DD05}","\u{D835}\u{DD1F}","=\u{20E5}","\u{22A5}","\u{2229}","\u{22D2}","\u{D835}\u{DD20}","\u{212D}","\u{03A7}","\u{03C7}","\u{25CB}","\u{222A}","\u{22D3}","\u{0414}","\u{0434}","\xB0","\u{2207}","\u{D835}\u{DD07}","\u{D835}\u{DD21}","\xA8","\xF7","\xA8","\u{02D9}","\u{042D}","\u{044D}","\u{D835}\u{DD08}","\u{D835}\u{DD22}","\u{2A96}","\u{2113}","\u{2A95}","\u{014A}","\u{014B}","\u{0397}","\u{03B7}","\xD0","\xF0","\u{0424}","\u{0444}","\u{D835}\u{DD09}","\u{D835}\u{DD23}","\u{2A86}","\u{0413}","\u{0433}","\u{2A8C}","\u{22DB}","\u{2265}","\u{2A7E}","\u{D835}\u{DD0A}","\u{D835}\u{DD24}","\u{22D9}","\u{2AA5}","\u{2A92}","\u{2AA4}","\u{2A88}","\u{2269}","^","\u{D835}\u{DD25}","\u{210C}","\u{0418}","\u{0438}","\u{21D4}","\u{D835}\u{DD26}","\u{2111}","\u{222B}","\u{222C}","\u{0419}","\u{0439}","\u{D835}\u{DD0D}","\u{D835}\u{DD27}","\u{041A}","\u{043A}","\u{D835}\u{DD0E}","\u{D835}\u{DD28}","\u{2A85}","\u{2AAB}","\u{041B}","\u{043B}","\u{2A8B}","\u{22DA}","\u{2264}","\u{2A7D}","\u{D835}\u{DD0F}","\u{D835}\u{DD29}","\u{2A91}","\u{2A87}","\u{2268}","\u{25CA}","\u{200E}","\u{21B0}","\u{21B0}","\u{2905}","\u{21A6}","\u{041C}","\u{043C}","\u{D835}\u{DD10}","\u{D835}\u{DD2A}","\u{2127}","\u{2223}","\u{2249}","\u{041D}","\u{043D}","\u{D835}\u{DD11}","\u{D835}\u{DD2B}","\u{2267}\u{0338}","\u{2271}","\u{22D9}\u{0338}","\u{226B}\u{20D2}","\u{226F}","\u{22FC}","\u{220B}","\u{2266}\u{0338}","\u{2270}","\u{22D8}\u{0338}","\u{226A}\u{20D2}","\u{226E}","\u{2AEC}","\xAC","\u{2280}","\u{2281}","#","\u{041E}","\u{043E}","\u{D835}\u{DD12}","\u{D835}\u{DD2C}","\u{29C1}","\u{03A9}","\u{29C0}","\u{2A5D}","\u{2A5B}","\u{2225}","\u{041F}","\u{043F}","\u{D835}\u{DD13}","\u{D835}\u{DD2D}","\u{03A6}","\u{03C6}","\u{03D6}","\u{2AAF}","\u{2AB3}","\u{03A8}","\u{03C8}","\u{D835}\u{DD14}","\u{D835}\u{DD2E}","\u{0420}","\u{0440}","\xAE","\xAE","\u{D835}\u{DD2F}","\u{211C}","\u{03A1}","\u{03C1}","\u{200F}","\u{21B1}","\u{21B1}","\u{2AB0}","\u{2AB4}","\u{0421}","\u{0441}","\u{D835}\u{DD16}","\u{D835}\u{DD30}","\xAD","\u{223C}","\u{2AAA}","/","\u{25A1}","\u{2282}","\u{22D0}","\u{2211}","\u{2211}","\u{2283}","\u{22D1}","\x09","\u{03A4}","\u{03C4}","\u{0422}","\u{0442}","\u{D835}\u{DD17}","\u{D835}\u{DD31}","\u{22A4}","\u{0423}","\u{0443}","\u{D835}\u{DD18}","\u{D835}\u{DD32}","\xA8","\u{0412}","\u{0432}","\u{2228}","\u{22C1}","\u{D835}\u{DD19}","\u{D835}\u{DD33}","\u{D835}\u{DD1A}","\u{D835}\u{DD34}","\u{D835}\u{DD1B}","\u{D835}\u{DD35}","\u{042B}","\u{044B}","\xA5","\u{D835}\u{DD1C}","\u{D835}\u{DD36}","\u{0417}","\u{0437}","\u{D835}\u{DD37}","\u{2128}","\u{200D}"];
$N2 = ["quot","andd","andv","ange","Aopf","aopf","apid","apos","Ascr","ascr","Auml","auml","Barv","bbrk","Beta","beta","beth","bNot","bnot","Bopf","bopf","boxh","boxH","boxv","boxV","bscr","Bscr","bsim","bsol","bull","bump","caps","Cdot","cdot","cent","CHcy","chcy","circ","cirE","cire","comp","cong","copf","Copf","copy","COPY","Cscr","cscr","csub","csup","cups","darr","Darr","dArr","dash","dHar","diam","DJcy","djcy","Dopf","dopf","Dscr","dscr","DScy","dscy","dsol","dtri","DZcy","dzcy","ecir","Edot","edot","eDot","emsp","ensp","Eopf","eopf","epar","epsi","escr","Escr","Esim","esim","Euml","euml","euro","excl","flat","fnof","Fopf","fopf","fork","fscr","Fscr","Gdot","gdot","geqq","gesl","GJcy","gjcy","gnap","gneq","Gopf","gopf","Gscr","gscr","gsim","gtcc","gvnE","half","harr","hArr","hbar","hopf","Hopf","hscr","Hscr","Idot","IEcy","iecy","imof","IOcy","iocy","Iopf","iopf","Iota","iota","iscr","Iscr","isin","Iuml","iuml","Jopf","jopf","Jscr","jscr","KHcy","khcy","KJcy","kjcy","Kopf","kopf","Kscr","kscr","lang","Lang","larr","Larr","lArr","late","lcub","ldca","ldsh","leqq","lesg","lHar","LJcy","ljcy","lnap","lneq","Lopf","lopf","lozf","lpar","lscr","Lscr","lsim","lsqb","ltcc","ltri","lvnE","macr","male","malt","mlcp","mldr","Mopf","mopf","mscr","Mscr","nang","napE","nbsp","ncap","ncup","ngeq","nges","ngtr","nGtv","nisd","NJcy","njcy","nldr","nleq","nles","nLtv","nmid","nopf","Nopf","npar","npre","nsce","Nscr","nscr","nsim","nsub","nsup","ntgl","ntlg","nvap","nvge","nvgt","nvle","nvlt","oast","ocir","odiv","odot","ogon","oint","omid","Oopf","oopf","opar","ordf","ordm","oror","Oscr","oscr","osol","Ouml","ouml","para","part","perp","phiv","plus","popf","Popf","prap","prec","prnE","prod","prop","Pscr","pscr","qint","qopf","Qopf","Qscr","qscr","race","rang","Rang","rarr","Rarr","rArr","rcub","rdca","rdsh","real","rect","rHar","rhov","ring","ropf","Ropf","rpar","rscr","Rscr","rsqb","rtri","scap","scnE","sdot","sect","semi","sext","SHcy","shcy","sime","simg","siml","smid","smte","solb","Sopf","sopf","spar","Sqrt","squf","Sscr","sscr","Star","star","subE","sube","succ","sung","sup1","sup2","sup3","supE","supe","tbrk","tdot","tint","toea","Topf","topf","tosa","trie","Tscr","tscr","TScy","tscy","uarr","Uarr","uArr","uHar","Uopf","uopf","upsi","Upsi","Uscr","uscr","utri","Uuml","uuml","varr","vArr","vBar","Vbar","vert","Vert","Vopf","vopf","Vscr","vscr","Wopf","wopf","Wscr","wscr","xcap","xcup","xmap","xnis","Xopf","xopf","Xscr","xscr","xvee","YAcy","yacy","YIcy","yicy","Yopf","yopf","Yscr","yscr","YUcy","yucy","yuml","Yuml","Zdot","zdot","Zeta","zeta","ZHcy","zhcy","zopf","Zopf","Zscr","zscr","zwnj"];
$D2 = ["\"","\u{2A5C}","\u{2A5A}","\u{29A4}","\u{D835}\u{DD38}","\u{D835}\u{DD52}","\u{224B}","'","\u{D835}\u{DC9C}","\u{D835}\u{DCB6}","\xC4","\xE4","\u{2AE7}","\u{23B5}","\u{0392}","\u{03B2}","\u{2136}","\u{2AED}","\u{2310}","\u{D835}\u{DD39}","\u{D835}\u{DD53}","\u{2500}","\u{2550}","\u{2502}","\u{2551}","\u{D835}\u{DCB7}","\u{212C}","\u{223D}","\\","\u{2022}","\u{224E}","\u{2229}\u{FE00}","\u{010A}","\u{010B}","\xA2","\u{0427}","\u{0447}","\u{02C6}","\u{29C3}","\u{2257}","\u{2201}","\u{2245}","\u{D835}\u{DD54}","\u{2102}","\xA9","\xA9","\u{D835}\u{DC9E}","\u{D835}\u{DCB8}","\u{2ACF}","\u{2AD0}","\u{222A}\u{FE00}","\u{2193}","\u{21A1}","\u{21D3}","\u{2010}","\u{2965}","\u{22C4}","\u{0402}","\u{0452}","\u{D835}\u{DD3B}","\u{D835}\u{DD55}","\u{D835}\u{DC9F}","\u{D835}\u{DCB9}","\u{0405}","\u{0455}","\u{29F6}","\u{25BF}","\u{040F}","\u{045F}","\u{2256}","\u{0116}","\u{0117}","\u{2251}","\u{2003}","\u{2002}","\u{D835}\u{DD3C}","\u{D835}\u{DD56}","\u{22D5}","\u{03B5}","\u{212F}","\u{2130}","\u{2A73}","\u{2242}","\xCB","\xEB","\u{20AC}","!","\u{266D}","\u{0192}","\u{D835}\u{DD3D}","\u{D835}\u{DD57}","\u{22D4}","\u{D835}\u{DCBB}","\u{2131}","\u{0120}","\u{0121}","\u{2267}","\u{22DB}\u{FE00}","\u{0403}","\u{0453}","\u{2A8A}","\u{2A88}","\u{D835}\u{DD3E}","\u{D835}\u{DD58}","\u{D835}\u{DCA2}","\u{210A}","\u{2273}","\u{2AA7}","\u{2269}\u{FE00}","\xBD","\u{2194}","\u{21D4}","\u{210F}","\u{D835}\u{DD59}","\u{210D}","\u{D835}\u{DCBD}","\u{210B}","\u{0130}","\u{0415}","\u{0435}","\u{22B7}","\u{0401}","\u{0451}","\u{D835}\u{DD40}","\u{D835}\u{DD5A}","\u{0399}","\u{03B9}","\u{D835}\u{DCBE}","\u{2110}","\u{2208}","\xCF","\xEF","\u{D835}\u{DD41}","\u{D835}\u{DD5B}","\u{D835}\u{DCA5}","\u{D835}\u{DCBF}","\u{0425}","\u{0445}","\u{040C}","\u{045C}","\u{D835}\u{DD42}","\u{D835}\u{DD5C}","\u{D835}\u{DCA6}","\u{D835}\u{DCC0}","\u{27E8}","\u{27EA}","\u{2190}","\u{219E}","\u{21D0}","\u{2AAD}","{","\u{2936}","\u{21B2}","\u{2266}","\u{22DA}\u{FE00}","\u{2962}","\u{0409}","\u{0459}","\u{2A89}","\u{2A87}","\u{D835}\u{DD43}","\u{D835}\u{DD5D}","\u{29EB}","(","\u{D835}\u{DCC1}","\u{2112}","\u{2272}","[","\u{2AA6}","\u{25C3}","\u{2268}\u{FE00}","\xAF","\u{2642}","\u{2720}","\u{2ADB}","\u{2026}","\u{D835}\u{DD44}","\u{D835}\u{DD5E}","\u{D835}\u{DCC2}","\u{2133}","\u{2220}\u{20D2}","\u{2A70}\u{0338}","\xA0","\u{2A43}","\u{2A42}","\u{2271}","\u{2A7E}\u{0338}","\u{226F}","\u{226B}\u{0338}","\u{22FA}","\u{040A}","\u{045A}","\u{2025}","\u{2270}","\u{2A7D}\u{0338}","\u{226A}\u{0338}","\u{2224}","\u{D835}\u{DD5F}","\u{2115}","\u{2226}","\u{2AAF}\u{0338}","\u{2AB0}\u{0338}","\u{D835}\u{DCA9}","\u{D835}\u{DCC3}","\u{2241}","\u{2284}","\u{2285}","\u{2279}","\u{2278}","\u{224D}\u{20D2}","\u{2265}\u{20D2}",">\u{20D2}","\u{2264}\u{20D2}","<\u{20D2}","\u{229B}","\u{229A}","\u{2A38}","\u{2299}","\u{02DB}","\u{222E}","\u{29B6}","\u{D835}\u{DD46}","\u{D835}\u{DD60}","\u{29B7}","\xAA","\xBA","\u{2A56}","\u{D835}\u{DCAA}","\u{2134}","\u{2298}","\xD6","\xF6","\xB6","\u{2202}","\u{22A5}","\u{03D5}","+","\u{D835}\u{DD61}","\u{2119}","\u{2AB7}","\u{227A}","\u{2AB5}","\u{220F}","\u{221D}","\u{D835}\u{DCAB}","\u{D835}\u{DCC5}","\u{2A0C}","\u{D835}\u{DD62}","\u{211A}","\u{D835}\u{DCAC}","\u{D835}\u{DCC6}","\u{223D}\u{0331}","\u{27E9}","\u{27EB}","\u{2192}","\u{21A0}","\u{21D2}","}","\u{2937}","\u{21B3}","\u{211C}","\u{25AD}","\u{2964}","\u{03F1}","\u{02DA}","\u{D835}\u{DD63}","\u{211D}",")","\u{D835}\u{DCC7}","\u{211B}","]","\u{25B9}","\u{2AB8}","\u{2AB6}","\u{22C5}","\xA7",";","\u{2736}","\u{0428}","\u{0448}","\u{2243}","\u{2A9E}","\u{2A9D}","\u{2223}","\u{2AAC}","\u{29C4}","\u{D835}\u{DD4A}","\u{D835}\u{DD64}","\u{2225}","\u{221A}","\u{25AA}","\u{D835}\u{DCAE}","\u{D835}\u{DCC8}","\u{22C6}","\u{2606}","\u{2AC5}","\u{2286}","\u{227B}","\u{266A}","\xB9","\xB2","\xB3","\u{2AC6}","\u{2287}","\u{23B4}","\u{20DB}","\u{222D}","\u{2928}","\u{D835}\u{DD4B}","\u{D835}\u{DD65}","\u{2929}","\u{225C}","\u{D835}\u{DCAF}","\u{D835}\u{DCC9}","\u{0426}","\u{0446}","\u{2191}","\u{219F}","\u{21D1}","\u{2963}","\u{D835}\u{DD4C}","\u{D835}\u{DD66}","\u{03C5}","\u{03D2}","\u{D835}\u{DCB0}","\u{D835}\u{DCCA}","\u{25B5}","\xDC","\xFC","\u{2195}","\u{21D5}","\u{2AE8}","\u{2AEB}","|","\u{2016}","\u{D835}\u{DD4D}","\u{D835}\u{DD67}","\u{D835}\u{DCB1}","\u{D835}\u{DCCB}","\u{D835}\u{DD4E}","\u{D835}\u{DD68}","\u{D835}\u{DCB2}","\u{D835}\u{DCCC}","\u{22C2}","\u{22C3}","\u{27FC}","\u{22FB}","\u{D835}\u{DD4F}","\u{D835}\u{DD69}","\u{D835}\u{DCB3}","\u{D835}\u{DCCD}","\u{22C1}","\u{042F}","\u{044F}","\u{0407}","\u{0457}","\u{D835}\u{DD50}","\u{D835}\u{DD6A}","\u{D835}\u{DCB4}","\u{D835}\u{DCCE}","\u{042E}","\u{044E}","\xFF","\u{0178}","\u{017B}","\u{017C}","\u{0396}","\u{03B6}","\u{0416}","\u{0436}","\u{D835}\u{DD6B}","\u{2124}","\u{D835}\u{DCB5}","\u{D835}\u{DCCF}","\u{200C}"];
$N3 = ["Acirc","acirc","acute","AElig","aelig","aleph","Alpha","alpha","Amacr","amacr","amalg","angle","angrt","angst","Aogon","aogon","Aring","aring","asymp","awint","bcong","bdquo","bepsi","blank","blk12","blk14","blk34","block","boxdl","boxdL","boxDl","boxDL","boxdr","boxdR","boxDr","boxDR","boxhd","boxHd","boxhD","boxHD","boxhu","boxHu","boxhU","boxHU","boxul","boxuL","boxUl","boxUL","boxur","boxuR","boxUr","boxUR","boxvh","boxvH","boxVh","boxVH","boxvl","boxvL","boxVl","boxVL","boxvr","boxvR","boxVr","boxVR","breve","Breve","bsemi","bsime","bsolb","bumpE","bumpe","caret","caron","ccaps","Ccirc","ccirc","ccups","cedil","check","clubs","colon","Colon","comma","crarr","cross","Cross","csube","csupe","ctdot","cuepr","cuesc","cupor","cuvee","cuwed","cwint","Dashv","dashv","dblac","ddarr","Delta","delta","dharl","dharr","diams","disin","doteq","dtdot","dtrif","duarr","duhar","Ecirc","ecirc","eDDot","efDot","Emacr","emacr","empty","Eogon","eogon","eplus","epsiv","eqsim","Equal","equiv","erarr","erDot","esdot","exist","fflig","filig","fjlig","fllig","fltns","forkv","frasl","frown","Gamma","gamma","Gcirc","gcirc","gescc","gimel","gneqq","gnsim","grave","gsime","gsiml","gtcir","gtdot","Hacek","harrw","Hcirc","hcirc","hoarr","Icirc","icirc","iexcl","iiint","iiota","IJlig","ijlig","Imacr","imacr","image","imath","imped","infin","Iogon","iogon","iprod","isinE","isins","isinv","Iukcy","iukcy","Jcirc","jcirc","jmath","Jukcy","jukcy","Kappa","kappa","lAarr","langd","laquo","larrb","lates","lbarr","lBarr","lbbrk","lbrke","lceil","ldquo","lescc","lhard","lharu","lhblk","llarr","lltri","lneqq","lnsim","loang","loarr","lobrk","lopar","lrarr","lrhar","lrtri","lsime","lsimg","lsquo","ltcir","ltdot","ltrie","ltrif","mdash","mDDot","micro","minus","mumap","nabla","napid","napos","natur","nbump","ncong","ndash","nearr","neArr","nedot","nesim","ngeqq","ngsim","nharr","nhArr","nhpar","nlarr","nlArr","nleqq","nless","nlsim","nltri","notin","notni","npart","nprec","nrarr","nrArr","nrtri","nsime","nsmid","nspar","nsubE","nsube","nsucc","nsupE","nsupe","numsp","nvsim","nwarr","nwArr","Ocirc","ocirc","odash","OElig","oelig","ofcir","ohbar","olarr","olcir","oline","Omacr","omacr","Omega","omega","operp","oplus","orarr","order","ovbar","parsl","phone","plusb","pluse","pound","prcue","prime","Prime","prnap","prsim","quest","rAarr","radic","rangd","range","raquo","rarrb","rarrc","rarrw","ratio","rbarr","rBarr","RBarr","rbbrk","rbrke","rceil","rdquo","reals","rhard","rharu","rlarr","rlhar","rnmid","roang","roarr","robrk","ropar","rrarr","rsquo","rtrie","rtrif","sbquo","sccue","Scirc","scirc","scnap","scsim","sdotb","sdote","searr","seArr","setmn","sharp","Sigma","sigma","simeq","simgE","simlE","simne","slarr","smile","smtes","sqcap","sqcup","sqsub","sqsup","srarr","starf","strns","subnE","subne","supnE","supne","swarr","swArr","szlig","Theta","theta","thkap","THORN","thorn","tilde","Tilde","times","trade","TRADE","trisb","TSHcy","tshcy","twixt","Ubrcy","ubrcy","Ucirc","ucirc","udarr","udhar","uharl","uharr","uhblk","ultri","Umacr","umacr","Union","Uogon","uogon","uplus","upsih","UpTee","Uring","uring","urtri","utdot","utrif","uuarr","varpi","vBarv","vdash","vDash","Vdash","VDash","veeeq","vltri","vnsub","vnsup","vprop","vrtri","Wcirc","wcirc","wedge","Wedge","xcirc","xdtri","xharr","xhArr","xlarr","xlArr","xodot","xrarr","xrArr","xutri","Ycirc","ycirc"];
$D3 = ["\xC2","\xE2","\xB4","\xC6","\xE6","\u{2135}","\u{0391}","\u{03B1}","\u{0100}","\u{0101}","\u{2A3F}","\u{2220}","\u{221F}","\xC5","\u{0104}","\u{0105}","\xC5","\xE5","\u{2248}","\u{2A11}","\u{224C}","\u{201E}","\u{03F6}","\u{2423}","\u{2592}","\u{2591}","\u{2593}","\u{2588}","\u{2510}","\u{2555}","\u{2556}","\u{2557}","\u{250C}","\u{2552}","\u{2553}","\u{2554}","\u{252C}","\u{2564}","\u{2565}","\u{2566}","\u{2534}","\u{2567}","\u{2568}","\u{2569}","\u{2518}","\u{255B}","\u{255C}","\u{255D}","\u{2514}","\u{2558}","\u{2559}","\u{255A}","\u{253C}","\u{256A}","\u{256B}","\u{256C}","\u{2524}","\u{2561}","\u{2562}","\u{2563}","\u{251C}","\u{255E}","\u{255F}","\u{2560}","\u{02D8}","\u{02D8}","\u{204F}","\u{22CD}","\u{29C5}","\u{2AAE}","\u{224F}","\u{2041}","\u{02C7}","\u{2A4D}","\u{0108}","\u{0109}","\u{2A4C}","\xB8","\u{2713}","\u{2663}",":","\u{2237}",",","\u{21B5}","\u{2717}","\u{2A2F}","\u{2AD1}","\u{2AD2}","\u{22EF}","\u{22DE}","\u{22DF}","\u{2A45}","\u{22CE}","\u{22CF}","\u{2231}","\u{2AE4}","\u{22A3}","\u{02DD}","\u{21CA}","\u{0394}","\u{03B4}","\u{21C3}","\u{21C2}","\u{2666}","\u{22F2}","\u{2250}","\u{22F1}","\u{25BE}","\u{21F5}","\u{296F}","\xCA","\xEA","\u{2A77}","\u{2252}","\u{0112}","\u{0113}","\u{2205}","\u{0118}","\u{0119}","\u{2A71}","\u{03F5}","\u{2242}","\u{2A75}","\u{2261}","\u{2971}","\u{2253}","\u{2250}","\u{2203}","\u{FB00}","\u{FB01}","fj","\u{FB02}","\u{25B1}","\u{2AD9}","\u{2044}","\u{2322}","\u{0393}","\u{03B3}","\u{011C}","\u{011D}","\u{2AA9}","\u{2137}","\u{2269}","\u{22E7}","`","\u{2A8E}","\u{2A90}","\u{2A7A}","\u{22D7}","\u{02C7}","\u{21AD}","\u{0124}","\u{0125}","\u{21FF}","\xCE","\xEE","\xA1","\u{222D}","\u{2129}","\u{0132}","\u{0133}","\u{012A}","\u{012B}","\u{2111}","\u{0131}","\u{01B5}","\u{221E}","\u{012E}","\u{012F}","\u{2A3C}","\u{22F9}","\u{22F4}","\u{2208}","\u{0406}","\u{0456}","\u{0134}","\u{0135}","\u{0237}","\u{0404}","\u{0454}","\u{039A}","\u{03BA}","\u{21DA}","\u{2991}","\xAB","\u{21E4}","\u{2AAD}\u{FE00}","\u{290C}","\u{290E}","\u{2772}","\u{298B}","\u{2308}","\u{201C}","\u{2AA8}","\u{21BD}","\u{21BC}","\u{2584}","\u{21C7}","\u{25FA}","\u{2268}","\u{22E6}","\u{27EC}","\u{21FD}","\u{27E6}","\u{2985}","\u{21C6}","\u{21CB}","\u{22BF}","\u{2A8D}","\u{2A8F}","\u{2018}","\u{2A79}","\u{22D6}","\u{22B4}","\u{25C2}","\u{2014}","\u{223A}","\xB5","\u{2212}","\u{22B8}","\u{2207}","\u{224B}\u{0338}","\u{0149}","\u{266E}","\u{224E}\u{0338}","\u{2247}","\u{2013}","\u{2197}","\u{21D7}","\u{2250}\u{0338}","\u{2242}\u{0338}","\u{2267}\u{0338}","\u{2275}","\u{21AE}","\u{21CE}","\u{2AF2}","\u{219A}","\u{21CD}","\u{2266}\u{0338}","\u{226E}","\u{2274}","\u{22EA}","\u{2209}","\u{220C}","\u{2202}\u{0338}","\u{2280}","\u{219B}","\u{21CF}","\u{22EB}","\u{2244}","\u{2224}","\u{2226}","\u{2AC5}\u{0338}","\u{2288}","\u{2281}","\u{2AC6}\u{0338}","\u{2289}","\u{2007}","\u{223C}\u{20D2}","\u{2196}","\u{21D6}","\xD4","\xF4","\u{229D}","\u{0152}","\u{0153}","\u{29BF}","\u{29B5}","\u{21BA}","\u{29BE}","\u{203E}","\u{014C}","\u{014D}","\u{03A9}","\u{03C9}","\u{29B9}","\u{2295}","\u{21BB}","\u{2134}","\u{233D}","\u{2AFD}","\u{260E}","\u{229E}","\u{2A72}","\xA3","\u{227C}","\u{2032}","\u{2033}","\u{2AB9}","\u{227E}","?","\u{21DB}","\u{221A}","\u{2992}","\u{29A5}","\xBB","\u{21E5}","\u{2933}","\u{219D}","\u{2236}","\u{290D}","\u{290F}","\u{2910}","\u{2773}","\u{298C}","\u{2309}","\u{201D}","\u{211D}","\u{21C1}","\u{21C0}","\u{21C4}","\u{21CC}","\u{2AEE}","\u{27ED}","\u{21FE}","\u{27E7}","\u{2986}","\u{21C9}","\u{2019}","\u{22B5}","\u{25B8}","\u{201A}","\u{227D}","\u{015C}","\u{015D}","\u{2ABA}","\u{227F}","\u{22A1}","\u{2A66}","\u{2198}","\u{21D8}","\u{2216}","\u{266F}","\u{03A3}","\u{03C3}","\u{2243}","\u{2AA0}","\u{2A9F}","\u{2246}","\u{2190}","\u{2323}","\u{2AAC}\u{FE00}","\u{2293}","\u{2294}","\u{228F}","\u{2290}","\u{2192}","\u{2605}","\xAF","\u{2ACB}","\u{228A}","\u{2ACC}","\u{228B}","\u{2199}","\u{21D9}","\xDF","\u{0398}","\u{03B8}","\u{2248}","\xDE","\xFE","\u{02DC}","\u{223C}","\xD7","\u{2122}","\u{2122}","\u{29CD}","\u{040B}","\u{045B}","\u{226C}","\u{040E}","\u{045E}","\xDB","\xFB","\u{21C5}","\u{296E}","\u{21BF}","\u{21BE}","\u{2580}","\u{25F8}","\u{016A}","\u{016B}","\u{22C3}","\u{0172}","\u{0173}","\u{228E}","\u{03D2}","\u{22A5}","\u{016E}","\u{016F}","\u{25F9}","\u{22F0}","\u{25B4}","\u{21C8}","\u{03D6}","\u{2AE9}","\u{22A2}","\u{22A8}","\u{22A9}","\u{22AB}","\u{225A}","\u{22B2}","\u{2282}\u{20D2}","\u{2283}\u{20D2}","\u{221D}","\u{22B3}","\u{0174}","\u{0175}","\u{2227}","\u{22C0}","\u{25EF}","\u{25BD}","\u{27F7}","\u{27FA}","\u{27F5}","\u{27F8}","\u{2A00}","\u{27F6}","\u{27F9}","\u{25B3}","\u{0176}","\u{0177}"];
$N4 = ["Aacute","aacute","Abreve","abreve","Agrave","agrave","andand","angmsd","angsph","apacir","approx","Assign","Atilde","atilde","barvee","barwed","Barwed","becaus","bernou","bigcap","bigcup","bigvee","bkarow","bottom","bowtie","boxbox","bprime","brvbar","bullet","Bumpeq","bumpeq","Cacute","cacute","capand","capcap","capcup","capdot","Ccaron","ccaron","Ccedil","ccedil","circeq","cirmid","Colone","colone","commat","compfn","conint","Conint","coprod","copysr","cularr","cupcap","CupCap","cupcup","cupdot","curarr","curren","cylcty","dagger","Dagger","daleth","Dcaron","dcaron","dfisht","divide","divonx","dlcorn","dlcrop","dollar","DotDot","drcorn","drcrop","Dstrok","dstrok","Eacute","eacute","easter","Ecaron","ecaron","ecolon","Egrave","egrave","egsdot","elsdot","emptyv","emsp13","emsp14","eparsl","eqcirc","equals","equest","Exists","female","ffilig","ffllig","forall","ForAll","frac12","frac13","frac14","frac15","frac16","frac18","frac23","frac25","frac34","frac35","frac38","frac45","frac56","frac58","frac78","gacute","Gammad","gammad","Gbreve","gbreve","Gcedil","gesdot","gesles","gtlPar","gtrarr","gtrdot","gtrsim","hairsp","hamilt","HARDcy","hardcy","hearts","hellip","hercon","homtht","horbar","hslash","Hstrok","hstrok","hybull","hyphen","Iacute","iacute","Igrave","igrave","iiiint","iinfin","incare","inodot","intcal","iquest","isinsv","Itilde","itilde","Jsercy","jsercy","kappav","Kcedil","kcedil","kgreen","Lacute","lacute","lagran","Lambda","lambda","langle","larrfs","larrhk","larrlp","larrpl","larrtl","latail","lAtail","lbrace","lbrack","Lcaron","lcaron","Lcedil","lcedil","ldquor","lesdot","lesges","lfisht","lfloor","lharul","llhard","Lmidot","lmidot","lmoust","loplus","lowast","lowbar","lparlt","lrhard","lsaquo","lsquor","Lstrok","lstrok","lthree","ltimes","ltlarr","ltrPar","mapsto","marker","mcomma","midast","midcir","middot","minusb","minusd","mnplus","models","mstpos","Nacute","nacute","nbumpe","Ncaron","ncaron","Ncedil","ncedil","nearhk","nequiv","nesear","nexist","nltrie","notinE","nparsl","nprcue","nrarrc","nrarrw","nrtrie","nsccue","nsimeq","Ntilde","ntilde","numero","nvdash","nvDash","nVdash","nVDash","nvHarr","nvlArr","nvrArr","nwarhk","nwnear","Oacute","oacute","Odblac","odblac","odsold","Ograve","ograve","ominus","origof","Oslash","oslash","Otilde","otilde","Otimes","otimes","parsim","percnt","period","permil","phmmat","planck","plankv","plusdo","plusdu","plusmn","preceq","primes","prnsim","propto","prurel","puncsp","qprime","Racute","racute","rangle","rarrap","rarrfs","rarrhk","rarrlp","rarrpl","Rarrtl","rarrtl","ratail","rAtail","rbrace","rbrack","Rcaron","rcaron","Rcedil","rcedil","rdquor","rfisht","rfloor","rharul","rmoust","roplus","rpargt","rsaquo","rsquor","rthree","rtimes","Sacute","sacute","Scaron","scaron","Scedil","scedil","scnsim","searhk","seswar","sfrown","SHCHcy","shchcy","sigmaf","sigmav","simdot","smashp","SOFTcy","softcy","solbar","spades","sqcaps","sqcups","sqsube","sqsupe","square","Square","squarf","ssetmn","ssmile","sstarf","subdot","subset","Subset","subsim","subsub","subsup","succeq","supdot","supset","Supset","supsim","supsub","supsup","swarhk","swnwar","target","Tcaron","tcaron","Tcedil","tcedil","telrec","there4","thetav","thinsp","thksim","timesb","timesd","topbot","topcir","tprime","tridot","Tstrok","tstrok","Uacute","uacute","Ubreve","ubreve","Udblac","udblac","ufisht","Ugrave","ugrave","ulcorn","ulcrop","urcorn","urcrop","Utilde","utilde","vangrt","varphi","varrho","Vdashl","veebar","vellip","verbar","Verbar","vsubnE","vsubne","vsupnE","vsupne","Vvdash","wedbar","wedgeq","weierp","wreath","xoplus","xotime","xsqcup","xuplus","xwedge","Yacute","yacute","Zacute","zacute","Zcaron","zcaron","zeetrf"];
$D4 = ["\xC1","\xE1","\u{0102}","\u{0103}","\xC0","\xE0","\u{2A55}","\u{2221}","\u{2222}","\u{2A6F}","\u{2248}","\u{2254}","\xC3","\xE3","\u{22BD}","\u{2305}","\u{2306}","\u{2235}","\u{212C}","\u{22C2}","\u{22C3}","\u{22C1}","\u{290D}","\u{22A5}","\u{22C8}","\u{29C9}","\u{2035}","\xA6","\u{2022}","\u{224E}","\u{224F}","\u{0106}","\u{0107}","\u{2A44}","\u{2A4B}","\u{2A47}","\u{2A40}","\u{010C}","\u{010D}","\xC7","\xE7","\u{2257}","\u{2AEF}","\u{2A74}","\u{2254}","@","\u{2218}","\u{222E}","\u{222F}","\u{2210}","\u{2117}","\u{21B6}","\u{2A46}","\u{224D}","\u{2A4A}","\u{228D}","\u{21B7}","\xA4","\u{232D}","\u{2020}","\u{2021}","\u{2138}","\u{010E}","\u{010F}","\u{297F}","\xF7","\u{22C7}","\u{231E}","\u{230D}","$","\u{20DC}","\u{231F}","\u{230C}","\u{0110}","\u{0111}","\xC9","\xE9","\u{2A6E}","\u{011A}","\u{011B}","\u{2255}","\xC8","\xE8","\u{2A98}","\u{2A97}","\u{2205}","\u{2004}","\u{2005}","\u{29E3}","\u{2256}","=","\u{225F}","\u{2203}","\u{2640}","\u{FB03}","\u{FB04}","\u{2200}","\u{2200}","\xBD","\u{2153}","\xBC","\u{2155}","\u{2159}","\u{215B}","\u{2154}","\u{2156}","\xBE","\u{2157}","\u{215C}","\u{2158}","\u{215A}","\u{215D}","\u{215E}","\u{01F5}","\u{03DC}","\u{03DD}","\u{011E}","\u{011F}","\u{0122}","\u{2A80}","\u{2A94}","\u{2995}","\u{2978}","\u{22D7}","\u{2273}","\u{200A}","\u{210B}","\u{042A}","\u{044A}","\u{2665}","\u{2026}","\u{22B9}","\u{223B}","\u{2015}","\u{210F}","\u{0126}","\u{0127}","\u{2043}","\u{2010}","\xCD","\xED","\xCC","\xEC","\u{2A0C}","\u{29DC}","\u{2105}","\u{0131}","\u{22BA}","\xBF","\u{22F3}","\u{0128}","\u{0129}","\u{0408}","\u{0458}","\u{03F0}","\u{0136}","\u{0137}","\u{0138}","\u{0139}","\u{013A}","\u{2112}","\u{039B}","\u{03BB}","\u{27E8}","\u{291D}","\u{21A9}","\u{21AB}","\u{2939}","\u{21A2}","\u{2919}","\u{291B}","{","[","\u{013D}","\u{013E}","\u{013B}","\u{013C}","\u{201E}","\u{2A7F}","\u{2A93}","\u{297C}","\u{230A}","\u{296A}","\u{296B}","\u{013F}","\u{0140}","\u{23B0}","\u{2A2D}","\u{2217}","_","\u{2993}","\u{296D}","\u{2039}","\u{201A}","\u{0141}","\u{0142}","\u{22CB}","\u{22C9}","\u{2976}","\u{2996}","\u{21A6}","\u{25AE}","\u{2A29}","*","\u{2AF0}","\xB7","\u{229F}","\u{2238}","\u{2213}","\u{22A7}","\u{223E}","\u{0143}","\u{0144}","\u{224F}\u{0338}","\u{0147}","\u{0148}","\u{0145}","\u{0146}","\u{2924}","\u{2262}","\u{2928}","\u{2204}","\u{22EC}","\u{22F9}\u{0338}","\u{2AFD}\u{20E5}","\u{22E0}","\u{2933}\u{0338}","\u{219D}\u{0338}","\u{22ED}","\u{22E1}","\u{2244}","\xD1","\xF1","\u{2116}","\u{22AC}","\u{22AD}","\u{22AE}","\u{22AF}","\u{2904}","\u{2902}","\u{2903}","\u{2923}","\u{2927}","\xD3","\xF3","\u{0150}","\u{0151}","\u{29BC}","\xD2","\xF2","\u{2296}","\u{22B6}","\xD8","\xF8","\xD5","\xF5","\u{2A37}","\u{2297}","\u{2AF3}","%",".","\u{2030}","\u{2133}","\u{210F}","\u{210F}","\u{2214}","\u{2A25}","\xB1","\u{2AAF}","\u{2119}","\u{22E8}","\u{221D}","\u{22B0}","\u{2008}","\u{2057}","\u{0154}","\u{0155}","\u{27E9}","\u{2975}","\u{291E}","\u{21AA}","\u{21AC}","\u{2945}","\u{2916}","\u{21A3}","\u{291A}","\u{291C}","}","]","\u{0158}","\u{0159}","\u{0156}","\u{0157}","\u{201D}","\u{297D}","\u{230B}","\u{296C}","\u{23B1}","\u{2A2E}","\u{2994}","\u{203A}","\u{2019}","\u{22CC}","\u{22CA}","\u{015A}","\u{015B}","\u{0160}","\u{0161}","\u{015E}","\u{015F}","\u{22E9}","\u{2925}","\u{2929}","\u{2322}","\u{0429}","\u{0449}","\u{03C2}","\u{03C2}","\u{2A6A}","\u{2A33}","\u{042C}","\u{044C}","\u{233F}","\u{2660}","\u{2293}\u{FE00}","\u{2294}\u{FE00}","\u{2291}","\u{2292}","\u{25A1}","\u{25A1}","\u{25AA}","\u{2216}","\u{2323}","\u{22C6}","\u{2ABD}","\u{2282}","\u{22D0}","\u{2AC7}","\u{2AD5}","\u{2AD3}","\u{2AB0}","\u{2ABE}","\u{2283}","\u{22D1}","\u{2AC8}","\u{2AD4}","\u{2AD6}","\u{2926}","\u{292A}","\u{2316}","\u{0164}","\u{0165}","\u{0162}","\u{0163}","\u{2315}","\u{2234}","\u{03D1}","\u{2009}","\u{223C}","\u{22A0}","\u{2A30}","\u{2336}","\u{2AF1}","\u{2034}","\u{25EC}","\u{0166}","\u{0167}","\xDA","\xFA","\u{016C}","\u{016D}","\u{0170}","\u{0171}","\u{297E}","\xD9","\xF9","\u{231C}","\u{230F}","\u{231D}","\u{230E}","\u{0168}","\u{0169}","\u{299C}","\u{03D5}","\u{03F1}","\u{2AE6}","\u{22BB}","\u{22EE}","|","\u{2016}","\u{2ACB}\u{FE00}","\u{228A}\u{FE00}","\u{2ACC}\u{FE00}","\u{228B}\u{FE00}","\u{22AA}","\u{2A5F}","\u{2259}","\u{2118}","\u{2240}","\u{2A01}","\u{2A02}","\u{2A06}","\u{2A04}","\u{22C0}","\xDD","\xFD","\u{0179}","\u{017A}","\u{017D}","\u{017E}","\u{2128}"];
$N5 = ["alefsym","angrtvb","angzarr","asympeq","backsim","because","Because","bemptyv","between","bigcirc","bigodot","bigstar","bnequiv","boxplus","Cayleys","Cconint","ccupssm","Cedilla","cemptyv","cirscir","coloneq","congdot","cudarrl","cudarrr","cularrp","curarrm","dbkarow","ddagger","ddotseq","demptyv","diamond","Diamond","digamma","dotplus","DownTee","dwangle","Element","Epsilon","epsilon","eqcolon","equivDD","gesdoto","gtquest","gtrless","harrcir","Implies","intprod","isindot","larrbfs","larrsim","lbrksld","lbrkslu","ldrdhar","LeftTee","lesdoto","lessdot","lessgtr","lesssim","lotimes","lozenge","ltquest","luruhar","maltese","minusdu","napprox","natural","nearrow","NewLine","nexists","NoBreak","notinva","notinvb","notinvc","NotLess","notniva","notnivb","notnivc","npolint","npreceq","nsqsube","nsqsupe","nsubset","nsucceq","nsupset","nvinfin","nvltrie","nvrtrie","nwarrow","olcross","Omicron","omicron","orderof","orslope","OverBar","pertenk","planckh","pluscir","plussim","plustwo","precsim","Product","quatint","questeq","rarrbfs","rarrsim","rbrksld","rbrkslu","rdldhar","realine","rotimes","ruluhar","searrow","simplus","simrarr","subedot","submult","subplus","subrarr","succsim","supdsub","supedot","suphsol","suphsub","suplarr","supmult","supplus","swarrow","topfork","triplus","tritime","uparrow","UpArrow","Uparrow","Upsilon","upsilon","uwangle","vzigzag","zigrarr"];
$D5 = ["\u{2135}","\u{22BE}","\u{237C}","\u{224D}","\u{223D}","\u{2235}","\u{2235}","\u{29B0}","\u{226C}","\u{25EF}","\u{2A00}","\u{2605}","\u{2261}\u{20E5}","\u{229E}","\u{212D}","\u{2230}","\u{2A50}","\xB8","\u{29B2}","\u{29C2}","\u{2254}","\u{2A6D}","\u{2938}","\u{2935}","\u{293D}","\u{293C}","\u{290F}","\u{2021}","\u{2A77}","\u{29B1}","\u{22C4}","\u{22C4}","\u{03DD}","\u{2214}","\u{22A4}","\u{29A6}","\u{2208}","\u{0395}","\u{03B5}","\u{2255}","\u{2A78}","\u{2A82}","\u{2A7C}","\u{2277}","\u{2948}","\u{21D2}","\u{2A3C}","\u{22F5}","\u{291F}","\u{2973}","\u{298F}","\u{298D}","\u{2967}","\u{22A3}","\u{2A81}","\u{22D6}","\u{2276}","\u{2272}","\u{2A34}","\u{25CA}","\u{2A7B}","\u{2966}","\u{2720}","\u{2A2A}","\u{2249}","\u{266E}","\u{2197}","\x0A","\u{2204}","\u{2060}","\u{2209}","\u{22F7}","\u{22F6}","\u{226E}","\u{220C}","\u{22FE}","\u{22FD}","\u{2A14}","\u{2AAF}\u{0338}","\u{22E2}","\u{22E3}","\u{2282}\u{20D2}","\u{2AB0}\u{0338}","\u{2283}\u{20D2}","\u{29DE}","\u{22B4}\u{20D2}","\u{22B5}\u{20D2}","\u{2196}","\u{29BB}","\u{039F}","\u{03BF}","\u{2134}","\u{2A57}","\u{203E}","\u{2031}","\u{210E}","\u{2A22}","\u{2A26}","\u{2A27}","\u{227E}","\u{220F}","\u{2A16}","\u{225F}","\u{2920}","\u{2974}","\u{298E}","\u{2990}","\u{2969}","\u{211B}","\u{2A35}","\u{2968}","\u{2198}","\u{2A24}","\u{2972}","\u{2AC3}","\u{2AC1}","\u{2ABF}","\u{2979}","\u{227F}","\u{2AD8}","\u{2AC4}","\u{27C9}","\u{2AD7}","\u{297B}","\u{2AC2}","\u{2AC0}","\u{2199}","\u{2ADA}","\u{2A39}","\u{2A3B}","\u{2191}","\u{2191}","\u{21D1}","\u{03A5}","\u{03C5}","\u{29A7}","\u{299A}","\u{21DD}"];
$N6 = ["andslope","angmsdaa","angmsdab","angmsdac","angmsdad","angmsdae","angmsdaf","angmsdag","angmsdah","angrtvbd","approxeq","awconint","backcong","barwedge","bbrktbrk","bigoplus","bigsqcup","biguplus","bigwedge","boxminus","boxtimes","bsolhsub","capbrcup","circledR","circledS","cirfnint","clubsuit","cupbrcap","curlyvee","cwconint","DDotrahd","doteqdot","DotEqual","dotminus","drbkarow","dzigrarr","elinters","emptyset","eqvparsl","fpartint","geqslant","gesdotol","gnapprox","hksearow","hkswarow","imagline","imagpart","infintie","integers","Integral","intercal","intlarhk","laemptyv","ldrushar","leqslant","lesdotor","LessLess","llcorner","lnapprox","lrcorner","lurdshar","mapstoup","multimap","naturals","ncongdot","NotEqual","notindot","NotTilde","otimesas","parallel","PartialD","plusacir","pointint","Precedes","precneqq","precnsim","profalar","profline","profsurf","raemptyv","realpart","RightTee","rppolint","rtriltri","scpolint","setminus","shortmid","smeparsl","sqsubset","sqsupset","subseteq","Succeeds","succneqq","succnsim","SuchThat","Superset","supseteq","thetasym","thicksim","timesbar","triangle","triminus","trpezium","Uarrocir","ulcorner","UnderBar","urcorner","varkappa","varsigma","vartheta"];
$D6 = ["\u{2A58}","\u{29A8}","\u{29A9}","\u{29AA}","\u{29AB}","\u{29AC}","\u{29AD}","\u{29AE}","\u{29AF}","\u{299D}","\u{224A}","\u{2233}","\u{224C}","\u{2305}","\u{23B6}","\u{2A01}","\u{2A06}","\u{2A04}","\u{22C0}","\u{229F}","\u{22A0}","\u{27C8}","\u{2A49}","\xAE","\u{24C8}","\u{2A10}","\u{2663}","\u{2A48}","\u{22CE}","\u{2232}","\u{2911}","\u{2251}","\u{2250}","\u{2238}","\u{2910}","\u{27FF}","\u{23E7}","\u{2205}","\u{29E5}","\u{2A0D}","\u{2A7E}","\u{2A84}","\u{2A8A}","\u{2925}","\u{2926}","\u{2110}","\u{2111}","\u{29DD}","\u{2124}","\u{222B}","\u{22BA}","\u{2A17}","\u{29B4}","\u{294B}","\u{2A7D}","\u{2A83}","\u{2AA1}","\u{231E}","\u{2A89}","\u{231F}","\u{294A}","\u{21A5}","\u{22B8}","\u{2115}","\u{2A6D}\u{0338}","\u{2260}","\u{22F5}\u{0338}","\u{2241}","\u{2A36}","\u{2225}","\u{2202}","\u{2A23}","\u{2A15}","\u{227A}","\u{2AB5}","\u{22E8}","\u{232E}","\u{2312}","\u{2313}","\u{29B3}","\u{211C}","\u{22A2}","\u{2A12}","\u{29CE}","\u{2A13}","\u{2216}","\u{2223}","\u{29E4}","\u{228F}","\u{2290}","\u{2286}","\u{227B}","\u{2AB6}","\u{22E9}","\u{220B}","\u{2283}","\u{2287}","\u{03D1}","\u{223C}","\u{2A31}","\u{25B5}","\u{2A3A}","\u{23E2}","\u{2949}","\u{231C}","_","\u{231D}","\u{03F0}","\u{03C2}","\u{03D1}"];
$N7 = ["backprime","backsimeq","Backslash","bigotimes","centerdot","CenterDot","checkmark","CircleDot","complexes","Congruent","Coproduct","dotsquare","DoubleDot","downarrow","DownArrow","Downarrow","DownBreve","gtrapprox","gtreqless","gvertneqq","heartsuit","HumpEqual","leftarrow","LeftArrow","Leftarrow","LeftFloor","lesseqgtr","LessTilde","lvertneqq","Mellintrf","MinusPlus","ngeqslant","nleqslant","NotCupCap","NotExists","NotSubset","nparallel","nshortmid","nsubseteq","nsupseteq","OverBrace","pitchfork","PlusMinus","rationals","spadesuit","subseteqq","subsetneq","supseteqq","supsetneq","therefore","Therefore","ThinSpace","triangleq","TripleDot","UnionPlus","varpropto"];
$D7 = ["\u{2035}","\u{22CD}","\u{2216}","\u{2A02}","\xB7","\xB7","\u{2713}","\u{2299}","\u{2102}","\u{2261}","\u{2210}","\u{22A1}","\xA8","\u{2193}","\u{2193}","\u{21D3}","\u{0311}","\u{2A86}","\u{22DB}","\u{2269}\u{FE00}","\u{2665}","\u{224F}","\u{2190}","\u{2190}","\u{21D0}","\u{230A}","\u{22DA}","\u{2272}","\u{2268}\u{FE00}","\u{2133}","\u{2213}","\u{2A7E}\u{0338}","\u{2A7D}\u{0338}","\u{226D}","\u{2204}","\u{2282}\u{20D2}","\u{2226}","\u{2224}","\u{2288}","\u{2289}","\u{23DE}","\u{22D4}","\xB1","\u{211A}","\u{2660}","\u{2AC5}","\u{228A}","\u{2AC6}","\u{228B}","\u{2234}","\u{2234}","\u{2009}","\u{225C}","\u{20DB}","\u{228E}","\u{221D}"];
$N8 = ["Bernoullis","circledast","CirclePlus","complement","curlywedge","eqslantgtr","EqualTilde","Fouriertrf","gtreqqless","ImaginaryI","Laplacetrf","LeftVector","lessapprox","lesseqqgtr","Lleftarrow","lmoustache","longmapsto","mapstodown","mapstoleft","nleftarrow","nLeftarrow","NotElement","NotGreater","nsubseteqq","nsupseteqq","precapprox","Proportion","rightarrow","RightArrow","Rightarrow","RightFloor","rmoustache","sqsubseteq","sqsupseteq","subsetneqq","succapprox","supsetneqq","ThickSpace","TildeEqual","TildeTilde","UnderBrace","UpArrowBar","UpTeeArrow","upuparrows","varepsilon","varnothing"];
$D8 = ["\u{212C}","\u{229B}","\u{2295}","\u{2201}","\u{22CF}","\u{2A96}","\u{2242}","\u{2131}","\u{2A8C}","\u{2148}","\u{2112}","\u{21BC}","\u{2A85}","\u{2A8B}","\u{21DA}","\u{23B0}","\u{27FC}","\u{21A7}","\u{21A4}","\u{219A}","\u{21CD}","\u{2209}","\u{226F}","\u{2AC5}\u{0338}","\u{2AC6}\u{0338}","\u{2AB7}","\u{2237}","\u{2192}","\u{2192}","\u{21D2}","\u{230B}","\u{23B1}","\u{2291}","\u{2292}","\u{2ACB}","\u{2AB8}","\u{2ACC}","\u{205F}\u{200A}","\u{2243}","\u{2248}","\u{23DF}","\u{2912}","\u{21A5}","\u{21C8}","\u{03F5}","\u{2205}"];
$N9 = ["backepsilon","blacksquare","circledcirc","circleddash","CircleMinus","CircleTimes","curlyeqprec","curlyeqsucc","diamondsuit","eqslantless","Equilibrium","expectation","GreaterLess","LeftCeiling","LessGreater","MediumSpace","NotLessLess","NotPrecedes","NotSucceeds","NotSuperset","nrightarrow","nRightarrow","OverBracket","preccurlyeq","precnapprox","quaternions","RightVector","Rrightarrow","RuleDelayed","SmallCircle","SquareUnion","straightphi","SubsetEqual","succcurlyeq","succnapprox","thickapprox","updownarrow","UpDownArrow","Updownarrow","VerticalBar"];
$D9 = ["\u{03F6}","\u{25AA}","\u{229A}","\u{229D}","\u{2296}","\u{2297}","\u{22DE}","\u{22DF}","\u{2666}","\u{2A95}","\u{21CC}","\u{2130}","\u{2277}","\u{2308}","\u{2276}","\u{205F}","\u{226A}\u{0338}","\u{2280}","\u{2281}","\u{2283}\u{20D2}","\u{219B}","\u{21CF}","\u{23B4}","\u{227C}","\u{2AB9}","\u{210D}","\u{21C0}","\u{21DB}","\u{29F4}","\u{2218}","\u{2294}","\u{03D5}","\u{2286}","\u{227D}","\u{2ABA}","\u{2248}","\u{2195}","\u{2195}","\u{21D5}","\u{2223}"];
$N10 = ["blacklozenge","DownArrowBar","DownTeeArrow","exponentiale","ExponentialE","GreaterEqual","GreaterTilde","HilbertSpace","HumpDownHump","Intersection","LeftArrowBar","LeftTeeArrow","LeftTriangle","LeftUpVector","NotCongruent","NotHumpEqual","NotLessEqual","NotLessTilde","Proportional","RightCeiling","risingdotseq","RoundImplies","ShortUpArrow","SquareSubset","triangledown","triangleleft","UnderBracket","varsubsetneq","varsupsetneq","VerticalLine"];
$D10 = ["\u{29EB}","\u{2913}","\u{21A7}","\u{2147}","\u{2147}","\u{2265}","\u{2273}","\u{210B}","\u{224E}","\u{22C2}","\u{21E4}","\u{21A4}","\u{22B2}","\u{21BF}","\u{2262}","\u{224F}\u{0338}","\u{2270}","\u{2274}","\u{221D}","\u{2309}","\u{2253}","\u{2970}","\u{2191}","\u{228F}","\u{25BF}","\u{25C3}","\u{23B5}","\u{228A}\u{FE00}","\u{228B}\u{FE00}","|"];
$N11 = ["ApplyFunction","bigtriangleup","blacktriangle","DifferentialD","divideontimes","DoubleLeftTee","DoubleUpArrow","fallingdotseq","hookleftarrow","leftarrowtail","leftharpoonup","LeftTeeVector","LeftVectorBar","LessFullEqual","longleftarrow","LongLeftArrow","Longleftarrow","looparrowleft","measuredangle","NotEqualTilde","NotTildeEqual","NotTildeTilde","ntriangleleft","Poincareplane","PrecedesEqual","PrecedesTilde","RightArrowBar","RightTeeArrow","RightTriangle","RightUpVector","shortparallel","smallsetminus","SucceedsEqual","SucceedsTilde","SupersetEqual","triangleright","UpEquilibrium","upharpoonleft","varsubsetneqq","varsupsetneqq","VerticalTilde","VeryThinSpace"];
$D11 = ["\u{2061}","\u{25B3}","\u{25B4}","\u{2146}","\u{22C7}","\u{2AE4}","\u{21D1}","\u{2252}","\u{21A9}","\u{21A2}","\u{21BC}","\u{295A}","\u{2952}","\u{2266}","\u{27F5}","\u{27F5}","\u{27F8}","\u{21AB}","\u{2221}","\u{2242}\u{0338}","\u{2244}","\u{2249}","\u{22EA}","\u{210C}","\u{2AAF}","\u{227E}","\u{21E5}","\u{21A6}","\u{22B3}","\u{21BE}","\u{2225}","\u{2216}","\u{2AB0}","\u{227F}","\u{2287}","\u{25B9}","\u{296E}","\u{21BF}","\u{2ACB}\u{FE00}","\u{2ACC}\u{FE00}","\u{2240}","\u{200A}"];
$N12 = ["curvearrowleft","DiacriticalDot","doublebarwedge","DoubleRightTee","downdownarrows","DownLeftVector","GreaterGreater","hookrightarrow","HorizontalLine","InvisibleComma","InvisibleTimes","LeftDownVector","leftleftarrows","leftrightarrow","LeftRightArrow","Leftrightarrow","leftthreetimes","LessSlantEqual","longrightarrow","LongRightArrow","Longrightarrow","looparrowright","LowerLeftArrow","NestedLessLess","NotGreaterLess","NotLessGreater","NotSubsetEqual","NotVerticalBar","nshortparallel","ntriangleright","OpenCurlyQuote","ReverseElement","rightarrowtail","rightharpoonup","RightTeeVector","RightVectorBar","ShortDownArrow","ShortLeftArrow","SquareSuperset","TildeFullEqual","trianglelefteq","upharpoonright","UpperLeftArrow","ZeroWidthSpace"];
$D12 = ["\u{21B6}","\u{02D9}","\u{2306}","\u{22A8}","\u{21CA}","\u{21BD}","\u{2AA2}","\u{21AA}","\u{2500}","\u{2063}","\u{2062}","\u{21C3}","\u{21C7}","\u{2194}","\u{2194}","\u{21D4}","\u{22CB}","\u{2A7D}","\u{27F6}","\u{27F6}","\u{27F9}","\u{21AC}","\u{2199}","\u{226A}","\u{2279}","\u{2278}","\u{2288}","\u{2224}","\u{2226}","\u{22EB}","\u{2018}","\u{220B}","\u{21A3}","\u{21C0}","\u{295B}","\u{2953}","\u{2193}","\u{2190}","\u{2290}","\u{2245}","\u{22B4}","\u{21BE}","\u{2196}","\u{200B}"];
$N13 = ["bigtriangledown","circlearrowleft","CloseCurlyQuote","ContourIntegral","curvearrowright","DoubleDownArrow","DoubleLeftArrow","downharpoonleft","DownRightVector","leftharpoondown","leftrightarrows","LeftRightVector","LeftTriangleBar","LeftUpTeeVector","LeftUpVectorBar","LowerRightArrow","nleftrightarrow","nLeftrightarrow","NotGreaterEqual","NotGreaterTilde","NotHumpDownHump","NotLeftTriangle","NotSquareSubset","ntrianglelefteq","OverParenthesis","RightDownVector","rightleftarrows","rightsquigarrow","rightthreetimes","ShortRightArrow","straightepsilon","trianglerighteq","UpperRightArrow","vartriangleleft"];
$D13 = ["\u{25BD}","\u{21BA}","\u{2019}","\u{222E}","\u{21B7}","\u{21D3}","\u{21D0}","\u{21C3}","\u{21C1}","\u{21BD}","\u{21C6}","\u{294E}","\u{29CF}","\u{2960}","\u{2958}","\u{2198}","\u{21AE}","\u{21CE}","\u{2271}","\u{2275}","\u{224E}\u{0338}","\u{22EA}","\u{228F}\u{0338}","\u{22EC}","\u{23DC}","\u{21C2}","\u{21C4}","\u{219D}","\u{22CC}","\u{2192}","\u{03F5}","\u{22B5}","\u{2197}","\u{22B2}"];
$N14 = ["circlearrowright","DiacriticalAcute","DiacriticalGrave","DiacriticalTilde","DoubleRightArrow","DownArrowUpArrow","downharpoonright","EmptySmallSquare","GreaterEqualLess","GreaterFullEqual","LeftAngleBracket","LeftUpDownVector","LessEqualGreater","NonBreakingSpace","NotPrecedesEqual","NotRightTriangle","NotSucceedsEqual","NotSucceedsTilde","NotSupersetEqual","ntrianglerighteq","rightharpoondown","rightrightarrows","RightTriangleBar","RightUpTeeVector","RightUpVectorBar","twoheadleftarrow","UnderParenthesis","UpArrowDownArrow","vartriangleright"];
$D14 = ["\u{21BB}","\xB4","`","\u{02DC}","\u{21D2}","\u{21F5}","\u{21C2}","\u{25FB}","\u{22DB}","\u{2267}","\u{27E8}","\u{2951}","\u{22DA}","\xA0","\u{2AAF}\u{0338}","\u{22EB}","\u{2AB0}\u{0338}","\u{227F}\u{0338}","\u{2289}","\u{22ED}","\u{21C1}","\u{21C9}","\u{29D0}","\u{295C}","\u{2954}","\u{219E}","\u{23DD}","\u{21C5}","\u{22B3}"];
$N15 = ["blacktriangledown","blacktriangleleft","DoubleUpDownArrow","DoubleVerticalBar","DownLeftTeeVector","DownLeftVectorBar","FilledSmallSquare","GreaterSlantEqual","LeftDoubleBracket","LeftDownTeeVector","LeftDownVectorBar","leftrightharpoons","LeftTriangleEqual","NegativeThinSpace","NotGreaterGreater","NotLessSlantEqual","NotNestedLessLess","NotReverseElement","NotSquareSuperset","NotTildeFullEqual","RightAngleBracket","rightleftharpoons","RightUpDownVector","SquareSubsetEqual","twoheadrightarrow","VerticalSeparator"];
$D15 = ["\u{25BE}","\u{25C2}","\u{21D5}","\u{2225}","\u{295E}","\u{2956}","\u{25FC}","\u{2A7E}","\u{27E6}","\u{2961}","\u{2959}","\u{21CB}","\u{22B4}","\u{200B}","\u{226B}\u{0338}","\u{2A7D}\u{0338}","\u{2AA1}\u{0338}","\u{220C}","\u{2290}\u{0338}","\u{2247}","\u{27E9}","\u{21CC}","\u{294F}","\u{2291}","\u{21A0}","\u{2758}"];
$N16 = ["blacktriangleright","DownRightTeeVector","DownRightVectorBar","longleftrightarrow","LongLeftRightArrow","Longleftrightarrow","NegativeThickSpace","NotLeftTriangleBar","PrecedesSlantEqual","ReverseEquilibrium","RightDoubleBracket","RightDownTeeVector","RightDownVectorBar","RightTriangleEqual","SquareIntersection","SucceedsSlantEqual"];
$D16 = ["\u{25B8}","\u{295F}","\u{2957}","\u{27F7}","\u{27F7}","\u{27FA}","\u{200B}","\u{29CF}\u{0338}","\u{227C}","\u{21CB}","\u{27E7}","\u{295D}","\u{2955}","\u{22B5}","\u{2293}","\u{227D}"];
$N17 = ["DoubleLongLeftArrow","DownLeftRightVector","LeftArrowRightArrow","leftrightsquigarrow","NegativeMediumSpace","NotGreaterFullEqual","NotRightTriangleBar","RightArrowLeftArrow","SquareSupersetEqual"];
$D17 = ["\u{27F8}","\u{2950}","\u{21C6}","\u{21AD}","\u{200B}","\u{2267}\u{0338}","\u{29D0}\u{0338}","\u{21C4}","\u{2292}"];
$N18 = ["CapitalDifferentialD","DoubleLeftRightArrow","DoubleLongRightArrow","EmptyVerySmallSquare","NestedGreaterGreater","NotDoubleVerticalBar","NotGreaterSlantEqual","NotLeftTriangleEqual","NotSquareSubsetEqual","OpenCurlyDoubleQuote","ReverseUpEquilibrium"];
$D18 = ["\u{2145}","\u{21D4}","\u{27F9}","\u{25AB}","\u{226B}","\u{2226}","\u{2A7E}\u{0338}","\u{22EC}","\u{22E2}","\u{201C}","\u{296F}"];
$N19 = ["CloseCurlyDoubleQuote","DoubleContourIntegral","FilledVerySmallSquare","NegativeVeryThinSpace","NotPrecedesSlantEqual","NotRightTriangleEqual","NotSucceedsSlantEqual"];
$D19 = ["\u{201D}","\u{222F}","\u{25AA}","\u{200B}","\u{22E0}","\u{22ED}","\u{22E1}"];

?>
