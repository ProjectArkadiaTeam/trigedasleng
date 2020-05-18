@extends('layouts.default.app')

@section('title', 'Grammar')

@section('content')
    <div id="inner">

        <div class="grammar">
            <h1>The Grammar of Trigedasleng</h1>

            <div class="entry" id="about-trigedasleng">
                <h2><a href="#about-trigedasleng">About Trigedasleng</a></h2>
                <p><p>Trigedasleng is a constructed language (conlang) developed by David J. Peterson for use on the CW show <i>The 100</i>. The Woods Clan (<i>Trigedakru</i>/<i>Trikru</i>) and Sand Nomads (<i>Sanskavakru</i>) have been heard using this language, but other groups of grounders (that is, earth-born people not born inside Mt. Weather) may also speak the language. Some of the Sky People (<i>Skaikru</i>; those from the Ark) began to learn Trigedasleng after repeated contact with the <i>Trigedakru</i>.</p>

                <p>Trigedasleng is descended from a heavily-accented dialect of American English. It has evolved rapidly over three generations. Its development was also influenced by an early code-system that was developed shortly after the Cataclysm, but this only affected the lexicon in any substantial way. At the time of the Ark's descent, it is believed that most grounders speak only Trigedasleng; warriors (and certain others, like Nyko the healer) speak both Trigedasleng and American English, a fact which they are careful to hide from their enemies.</p>

                <p>Trigedasleng is <i>not</i> a creole, but a descendant of American English alone, and while it may share similarities with AAVE (African American Vernacular English, which is also derived from American English), those similarities are not intentional, and Trigedasleng does not derive from AAVE.</p></p>
            </div>
            <!--  -->

            <div class="entry" id="pronunciation-writing">
                <h2><a href="#pronunciation-writing">Pronunciation &amp; Writing</a></h2>
                <p><p>Trigedasleng doesn't have its own writing system. The bits of writing that have survived the last 97 years are incomplete and have probably been passed down from warrior to warrior along with English. The writers of <i>The 100</i> asked Peterson to use a simplified spelling system for the scripts, instead of using more English-like spelling rules. The table below illustrates this simplified system.</p>

                <table class="grammar">
                    <tr><th>Vowel</th><th>Sounds Like</th><th colspan="2">English Name</th></tr>
                    <tr><td>A, a*</td><td><u><b>a</b></u>pple</td><td colspan="2">short A</td></tr>
                    <tr><td>Ai, ai</td><td><b><u>i</u></b>ce</td><td colspan="2">long I</td></tr>
                    <tr><td>E, e</td><td>g<b><u>e</u></b>t</td><td colspan="2">short E</td></tr>
                    <tr><td>Ei, ei</td><td>f<b><u>a</u></b>ce</td><td colspan="2">long A</td></tr>
                    <tr><td>I, i</td><td>m<b><u>ee</u></b>t OR k<b><u>i</u></b>d</td><td colspan="2">long E / short I</td></tr>
                    <tr><td>O, o</td><td>l<b><u>aw</u></b> OR s<b><u>o</u></b>n</td><td colspan="2">short O / short U</td></tr>
                    <tr><td>Ou, ou</td><td>wr<b><u>o</u></b>te</td><td colspan="2">long O</td></tr>
                    <tr><td>U, u</td><td>r<b><u>u</u></b>de</td><td colspan="2">long U</td></tr>
                    <tr><td>* A, a (end of word)</td><td>sof<b><u>a</u></b></td><td colspan="2">schwa</td></tr>
                    <tr><td>Au, au (diphthongized)</td><td>l<b><u>ou</u></b>d</td><td colspan="2">"ow"</td></tr>
                    <tr><td colspan="4">  </td></tr>
                    <tr><th>Consonant</th><th>Sounds Like</th><th>Consonant</th><th>Sounds Like</th></tr>
                    <tr><td>B, b</td><td>ball</td><td>P, p</td><td>pull</td></tr>
                    <tr><td>Ch, ch</td><td>chair</td><td>R, r</td><td>radio</td></tr>
                    <tr><td>D, d</td><td>daft</td><td>S, s</td><td>seven</td></tr>
                    <tr><td>F, f</td><td>fire</td><td>Sh, sh</td><td>shine</td></tr>
                    <tr><td>G, g</td><td>good (<i>not</i> giraffe)</td><td>T, t</td><td>talk</td></tr>
                    <tr><td>H, h</td><td>hello</td><td>Th, th</td><td>think (<i>not</i> these)</td></tr>
                    <tr><td>J, j</td><td>juice</td><td>V, v</td><td>viking</td></tr>
                    <tr><td>K, k</td><td>kick</td><td>W, w</td><td>water</td></tr>
                    <tr><td>L, l</td><td>lime</td><td>Y, y</td><td>yellow</td></tr>
                    <tr><td>M, m</td><td>made</td><td>Z, z</td><td>zipper</td></tr>
                    <tr><td>N, n</td><td>need</td></tr>
                </table>
                <p>Trigedasleng does not use the letters C, Q, or X.</p></p>
            </div>
            <!--  -->

            <div class="entry" id="names">
                <h2><a href="#names">Names</a></h2>
                <p><p>Names in Trigedasleng are rendered phonetically, or 'sounded out', based on the system above. Here are a few examples from the show:</p>
                <table class="grammar">
                    <tr>
                        <th>Bellamy</th>
                        <th>Octavia</th>
                        <th>Clarke</th>
                        <th>Lincoln</th>
                        <th>Lexa</th>
                        <th>Gustus</th>
                        <th>Nyko</th>
                    </tr>
                    <tr>
                        <td>Belomi</td>
                        <td>Okteivia</td>
                        <td>Klark*</td>
                        <td>Linkon</td>
                        <td>Leksa</td>
                        <td>Gostos</td>
                        <td>Naikou</td>
                    </tr>
                    <tr>
                        <td colspan="7">* Peterson originally transcribed Clarke's name as <i>Klok</i>, but later corrected the spelling to <i>Klark</i>.</td>
                    </tr>
                </table>

                <p>Note that names are not translated into Trigedasleng, only transcribed.</p>

                <p>Surnames are also transcribed in Trigedasleng, and are handled as a second given name. For example, "Clarke Griffin of the Sky People" is <i>Klark Grifin kom Skaikru</i> and not, say, <i>Klark kom Grifinkru</i>.</p>
                <p>When writing in Trigedasleng, it is the author/speaker's decision whether to use respelled names or to use Modern English spellings. Because of Trigedasleng's descent from American English and the romanization system devised for the language, many names are spelled identically or nearly-identically either way.</p></p>
            </div>
            <!--  -->

            <div class="entry" id="verbs">
                <h2><a href="#verbs">Verbs</a></h2>
                <p><p>Verbs in Trigedasleng have the biggest differences from English of any part of speech. Trigedasleng verbs have two parts: the verb root, and one of nine satellites. </p>
                <p>Some verbs don't have or require satellites (auxiliary/modal verbs, function verbs, causative/performative verbs, verbs having to do with agent-initiated motion). These verbs can co-occur with satellites, but that typically changes their meaning.</p></p>
            </div>
            <!--  -->

            <div class="entry" id="satellites">
                <h2><a href="#satellites">Satellites</a></h2>
                <p><p>Most verbs have a satellite that directly follows the direct object, if one is present. If a direct object is not present, the satellite follows the verb root. Satellites precede indirect objects and other phrases which follow the verb.</p>
                <p>Nine satellites have been seen in Trigedasleng—<i>op, in, au, we, of, raun, daun, klin, thru</i>—though more may exist.</p>
                <p>Some useful guidelines for satellites follows:</p>
                <ul>
                    <li><i>raun</i>: used for base-transitive verbs when used intransitively, and replaces the transitive satellite (usually <i>op</i> or <i>in</i>); also used for many base-intransitive verbs</li>
                    <li><i>op</i>: typically attached to concrete verbs (verbs for doing and acting on the physical world)</li>
                    <li><i>in</i>: typically attached to abstract verbs (verbs for things like thinking and saying and hearing, which have less impact on the physical world)</li>
                    <li><i>klin</i>: indicates finality and has special uses</li>
                    <li><i>au</i>: typically used where its English ancestor ("out") would be used</li>
                    <li><i>we</i>: typically used where its English ancestor ("away") would be used</li>
                    <li><i>daun</i>: typically used where its English ancestor ("down") would be used; n.b. the second-tier demonstrative <i>daun</i> ("that-one-here")</li>
                    <li><i>thru</i>: indicates continuation or progressive action (e.g. <i>kik raun</i> "to live" vs <i>kik thru</i> "to survive")</li>
                </ul></p>
            </div>
            <!--  -->

            <div class="entry" id="copulas">
                <h2><a href="#copulas">Copulas</a></h2>
                <p><p>There are three copulas ("to be" words) in Trigedasleng. </p>

                <p><i>Ste</i>, the stative copula, is used with adjectives, and with verb phrases as a progressive auxiliary (see topic "Auxiliaries &amp; Modals").</p>
                <ul>
                    <li><i>em ste tofon</i> "it is difficult"</li>
                    <li><i>ai ste yuj</i> "I am strong"</li>
                    <li><i>emo ste gon choda op</i> "they are fighting each other"</li>
                </ul>

                <p><i>Laik</i> is used with nouns and adverbial or prepositional phrases.</p>
                <ul>
                    <li><i>em laik tofon</i> "it is a difficult thing"</li>
                    <li><i>ai laik ticha</i> "I am a teacher"</li>
                    <li><i>emo laik kom trigeda</i> "they are from the forest"</li>
                </ul>

                <p><i>Bilaik</i> can also be used as a figurative or circumstantial copula with nouns, adjectives, and adverbial/prepositional phrases. (It's kind of like using air quotes.) Its use in certain contexts may indicate disdain.</p>
                <ul>
                    <li><i>em bilaik tofon</i> "it is 'difficult' (so to speak)" or "it's a 'difficult' thing"</li>
                    <li><i>ai bilaik ticha</i> "I'm a 'teacher' (I guess/for all intents and purposes)"</li>
                    <li><i>emo nou bilaik gonakru</i> "they aren't (real) warriors"</li>
                    <li><i>du bilaik splita</i></li> "he's an outcast" (<i>du</i> indicates disdain or contempt)
                </ul></p>
            </div>
            <!--  -->

            <div class="entry" id="auxiliaries-modals">
                <h2><a href="#auxiliaries-modals">Auxiliaries &amp; Modals</a></h2>
                <p><p>Auxiliary and modal verbs are used in a variety of ways. Primarily, they are used to form the tense structure of Trigedasleng, but there are other ways to use them. The future tense, for example, is also used for "in order to" phrases and dynamic modality ("I can"). Trigedasleng also fails to distinguish perfect tenses, and uses only a simple past tense.</p>

                <ul>
                    <h4><b>Present tense</b>: no auxiliary</h4>
                    <li><i>ai fis em op</i> "I heal him"</li>

                    <h4><b>Past tense</b>: <i>don</i></h4>
                    <li><i>ai don fis em op</i> "I healed him"</li>
                    <li><i>ai don fis em op</i> "I have healed him"</li>
                    <li><i>ai don fis em op </i>"I had healed him"</li>

                    <h4><b>Future tense</b>: <i>na</i></h4>
                    <li><i></i><i>ai na fis em op</i> "I will heal him"</li>
                    <li><i>ai na fis em op </i>"I can heal him"</li>
                    <li><i>ai don fis em op na sis oso au</i> "I healed him in order to help us"</li>

                    <h4><b>Passive aspect</b>: <i>ge</i></h4>
                    <li><i>ai ge fis op</i> "I get healed"</li>
                    <li><i>ai ge fis op</i> "I am healed"</li>

                    <h4><b>Progressive</b>: <i>ste</i></h4>
                    <li><i>ai ste fis em op</i> "I am healing him"</li>
                    <li><i>ai don ste fis em op</i> "I was healing him"</li>
                    <li><i>ai na ste fis em op</i> "I will be healing him"</li>

                    <h4><b>Modality</b>: <i>beda</i> and <i>souda</i></h4>
                    <li><i>ai beda fis em op</i> "I should heal him"</li>
                    <li><i>ai souda fis em op</i> "I must heal him"</li>
                    <li><i>ai beda don fis em op</i> "I should have healed him"</li>

                    <h4><b>Question negation</b>: <i>din</i></h4>
                    <li><i>din yu don fis em op?</i> "didn't you heal him?"</li>
                    <li><i>din yu na fis em op?</i> "won't you heal him?"</li>
                    <li><i>din em ge fis op?</i> "isn't he healed?"</li>
                </ul></p>
            </div>
            <!--  -->

            <div class="entry" id="nouns-adjectives">
                <h2><a href="#nouns-adjectives">Nouns &amp; Adjectives</a></h2>
                <p><p>Nouns and adjectives have no plurals or case distinctions. It is possible to emphasize plurality using <i>emo</i> or a plural-possessive pronoun.</p>
                <table class="gloss">
                    <tr class="tgs_gloss"><td>emo</td><td>hon</td><td>emo</td><td>sobwe</td><td>op</td></tr>
                    <tr class="leipzig_gloss"><td>3PL</td><td>find</td><td>3PL</td><td>tunnel</td><td>SAT</td></tr>
                    <tr class="gloss_en"><td colspan="5">they find (plural) tunnels</td></tr>
                </table>
                <p>Adjectives are placed before the noun they modify.</p></p>
            </div>
            <!--  -->

            <div class="entry" id="pronouns">
                <h2><a href="#pronouns">Pronouns</a></h2>
                <p><h4>Independent Pronouns</h4>
                <table class="grammar">
                    <tr>
                        <th> </th>
                        <th>singular</th>
                        <th>plural</th>
                    </tr>
                    <tr>
                        <th>first person</th>
                        <td>ai</td>
                        <td>oso (inclusive), osir (exclusive)</td>
                    </tr>
                    <tr>
                        <th>second person</th>
                        <td>yu</td>
                        <td>yo</td>
                    </tr>
                    <tr>
                        <th>third person</th>
                        <td>em, du (pejorative)</td>
                        <td>emo, du (pejorative)</td>
                    </tr>
                </table>

                <p>Use <i>oso</i> to include the person the speaker is addressing; use <i>osir</i> to exclude the person the speaker is addressing. Use <i>du</i> when the person or thing referred to is held in disdain or contempt, <i>or</i> to mean "someone".</p>
                <p><i>Yumi</i> is a third "first person plural" pronoun, and literally means "you-and-me."</p>
                <ul>
                    <li><i>ai laik Skayon</i> "I am a Sky-Person"</li>
                    <li><i>oso laik raunon</i> "we are [all] people" (<i>oso</i> includes the addressee)</li>
                    <li><i>osir laik gona, ba yu laik fisa</i> "we are warriors, but you are a healer" (<i>osir</i> excludes the addressee)</li>
                    <li><i>yumi na chich oso heda op</i> "you and I will talk to our commander"</li>
                    <li><i>yu laik fisa</i> "you are a healer"</li>
                    <li><i>yo na gon raun</i> "you-all will fight"</li>
                    <li><i>em ste yuj</i> "he is strong"</li>
                    <li><i>du ste kwelen</i> "he is weak" (<i>du</i> indicates that "he" is not respected or liked by the speaker)</li>
                    <li><i>emo don hon sobwe-de op</i> "they found the tunnel"</li>
                    <li><i>du ste torch ai op</i> "they are torturing me"</li>
                    <li><i>du na hon em op</i> "someone will find it"</li>
                </ul>

                <h4>Possessive Pronouns</h4>
                <table class="grammar">
                    <tr>
                        <th> </th>
                        <th>singular</th>
                        <th>plural</th>
                    </tr>
                    <tr>
                        <th>first person</th>
                        <td>ain, omon</td>
                        <td>oson</td>
                    </tr>
                    <tr>
                        <th>second person</th>
                        <td>yun, oyun</td>
                        <td>yon, oyon</td>
                    </tr>
                    <tr>
                        <th>third person</th>
                        <td>emon, omon</td>
                        <td>emon, omon</td>
                    </tr>
                </table>

                <p>The pairs of pronouns in the cells above indicate whether the thing being referred to is singular or plural.</p>
                <ul>
                    <li><i>dison laik ain</i> "this is mine"</li>
                    <li><i>dison laik omon</i> "these are mine"</li>
                    <li><i>dison laik oson</i> "this/these is/are ours (not you)" "this/these is/are ours (all of us)"</li>
                    <li><i>dison laik yun</i> "this is yours"</li>
                    <li><i>dison laik oyun</i> "these are yours"</li>
                    <li><i>dison laik yon</i> "this is y'all's"</li>
                    <li><i>dison laik oyon</i> "these are y'all's"</li>
                    <li><i>dison laik emon</i> "this is his/hers/its/theirs"</li>
                    <li><i>dison laik omon</i> "these are his/hers/its/theirs"</li>
                </ul>

                <h4>Possessive Adjectives</h4>
                <table class="grammar">
                    <tr>
                        <th> </th>
                        <th>singular</th>
                        <th>plural</th>
                    </tr>
                    <tr>
                        <th>first person</th>
                        <td>ai, oma</td>
                        <td>(oso, osir)</td>
                    </tr>
                    <tr>
                        <th>second person</th>
                        <td>yu, oyu</td>
                        <td>yo, oyo</td>
                    </tr>
                    <tr>
                        <th>third person</th>
                        <td>em, om</td>
                        <td>emo, omo</td>
                    </tr>
                </table>

                <p>These look pretty much like the independent pronouns, but each of the cells except first person plural has an alternate "plural referent" form. The alternate form is used when the thing being possessed/owned is plural.</p>
                <ul>
                    <li><i>ai java</i> "my spear"</li>
                    <li><i>oma java</i> "my spears"</li>
                    <li><i>oso stegeda</i> "our village/s (all of us)"</li>
                    <li><i>osir stegeda</i> "our village/s (but not yours)"</li>
                    <li><i>yu java</i> "your spear"</li>
                    <li><i>oyu java</i> "your spears"</li>
                    <li><i>yo stegeda</i> "y'all's village"</li>
                    <li><i>oyo java</i> "y'all's spears"</li>
                    <li><i>em java</i> "his/her/its spear"</li>
                    <li><i>om java</i> "his/her/its spears"</li>
                    <li><i>emo stegeda</i> "their village"</li>
                    <li><i>omo java</i> "their spears"</li>
                </ul>

                <p><i>Yumi</i> has no possessive forms; instead use the standard first person plural forms.</p></p>
            </div>
            <!--  -->

            <div class="entry" id="demonstratives">
                <h2><a href="#demonstratives">Demonstratives</a></h2>
                <p><p>Trigedasleng enjoys a three-way distinction for demonstrative pronouns, demonstrative adjectives, and spatial adverbs.</p>
                <table class="grammar">
                    <tr>
                        <td></td>
                        <th>this-here (1)</th>
                        <th>that-near (2)</th>
                        <th>that-far (3)</th>
                    </tr>
                    <tr>
                        <th>demonstrative pronoun</th>
                        <td>dison</td>
                        <td>daun</td>
                        <td>daunde</td>
                    </tr>
                    <tr>
                        <th>demonstrative adjective</th>
                        <td>disha</td>
                        <td>dei</td>
                        <td>dei de (circumfixed)</td>
                    </tr>
                    <tr>
                        <th>spatial adverb</th>
                        <td>hir</td>
                        <td>der</td>
                        <td>ouder</td>
                    </tr>
                </table>
                <p>For more information on each word, check the respective dictionary entries.</p></p>
            </div>
            <!--  -->

            <div class="entry" id="possession">
                <h2><a href="#possession">Possession</a></h2>
                <p><p>Aside from the possessive pronouns and possessive adjectives (see topic "Pronouns"), non-pronominal kinds of possession/belonging are formed either by apposition or, in some cases, using <i>kom</i>.</p>
                <ul>
                    <li><i>Leksa swis</i> "Lexa's knife"</li>
                    <li><i>Abi yongon</i> "Abby's child"</li>
                    <li><i>Okteivia kom Skaikru</i> "Octavia of the Sky People"</li>
                    <li><i>heda kom stegeda</i> "the village's leader"</li>
                </ul></p>
            </div>
            <!--  -->

            <div class="entry" id="number-system">
                <h2><a href="#number-system">Numbers and Counting</a></h2>
                <p><p>Trigedasleng's number system is inherited from English, so the bulk of the changes are mere respellings to comply with the romanization system developed by David Peterson.</p>

                <table class="grammar">
                    <tr><th colspan="6">Cardinal Numbers</th></tr>
                    <tr><th>1</th>	<td>won</td>	<th>11</th>	<td>len</td>	<th>30</th>	<td>thodi</td>			</tr>
                    <tr><th>2</th>	<td>tu</td>		<th>12</th>	<td>twel</td>	<th>40</th>	<td>fodi</td>			</tr>
                    <tr><th>3</th>	<td>thri</td>	<th>13</th>	<td>thotin</td>	<th>50</th>	<td>fidi</td>			</tr>
                    <tr><th>4</th>	<td>fou</td>	<th>14</th>	<td>fotin</td>	<th>60</th>	<td>sisti</td>			</tr>
                    <tr><th>5</th>	<td>fai</td>	<th>15</th>	<td>fitin</td>	<th>70</th>	<td>sendi</td>			</tr>
                    <tr><th>6</th>	<td>sis</td>	<th>16</th>	<td>sistin</td>	<th>80</th>	<td>eidi</td>			</tr>
                    <tr><th>7</th>	<td>sen</td>	<th>17</th>	<td>sentin</td>	<th>90</th>	<td>naidi</td>			</tr>
                    <tr><th>8</th>	<td>eit</td>	<th>18</th>	<td>eitin</td>	<th>100</th><td>honet</td>			</tr>
                    <tr><th>9</th>	<td>nain</td>	<th>19</th>	<td>naitin</td>	<th>1000</th><td>thauz</td>			</tr>
                    <tr><th>10</th>	<td>ten</td>	<th>20</th>	<td>tweni</td>	<th>million, billion</th>	<td>miyon, biyon</td>	</tr>
                </table>

                <p>Numbers are put together the same way they are in English: irregular numbers up to twenty, followed by <i>tweni won, tweni tu</i>, etc. Large numbers also follow English rules: <i>tu honet fidi fai</i> (255)</p>

                <table class="grammar">
                    <tr><th colspan="6">Ordinal Numbers</th></tr>
                    <tr><th>1st</th>	<td>fos</td>	<th>11th</th>	<td>lenon</td>	<th>30th</th>	<td>thotit</td>	</tr>
                    <tr><th>2nd</th>	<td>seken</td>	<th>12th</th>	<td>twelon</td>	<th>40th</th>	<td>fodit</td>	</tr>
                    <tr><th>3rd</th>	<td>thot</td>	<th>13th</th>	<td>thotinon</td>	<th>50th</th>	<td>fidit</td>	</tr>
                    <tr><th>4th</th>	<td>fot</td>	<th>14th</th>	<td>fotinon</td>	<th>60th</th>	<td>sistit</td>	</tr>
                    <tr><th>5th</th>	<td>fit</td>	<th>15th</th>	<td>fitinon</td>	<th>70th</th>	<td>sentit</td>	</tr>
                    <tr><th>6th</th>	<td>sison</td>	<th>16th</th>	<td>sistinon</td>	<th>80th</th>	<td>eidit</td>	</tr>
                    <tr><th>7th</th>	<td>senon</td>	<th>17th</th>	<td>sentinon</td>	<th>90th</th>	<td>naidit</td>	</tr>
                    <tr><th>8th</th>	<td>eidon</td>	<th>18th</th>	<td>eitinon</td>	<th>100th</th>	<td>honet</td>	</tr>
                    <tr><th>9th</th>	<td>nainon</td>	<th>19th</th>	<td>naitinon</td>	<th>1000th</th>	<td>thauzet</td>	</tr>
                    <tr><th>10th</th>	<td>tenon</td>	<th>20th</th>	<td>twenit</td>	<th>millionth</th>	<td>miyonet</td>	</tr>
                </table>

                <p>Most ordinal numbers, with a few exceptions, are simply the cardinal number + <i>-on</i>, except multiples of ten (+ <i>-t</i>), one hundred (no change), and powers of ten (+ <i>-et</i>). As with English, ordinals that have multiple components (24th, 112th) only have an ordinal at the end (<i>tweni fot, honet twelon</i>).</p></p>
            </div>
            <!--  -->

            <div class="entry" id="prepositions">
                <h2><a href="#prepositions">Prepositions</a></h2>
                <p><p>There are a limited number of prepositions in Trigedasleng, so each one has many different meanings that are context-dependent.</p>
                <ul>
                    <li><i>gon</i>: for, on, to, at, against, towards, because of, upon...</li>
                    <ul>
                        <li><i>yumi na throu daun gon emo</i> "you and I will fight aganst them"</li>
                        <li><i>stedaun gon Skaikru!</i> "death to Sky People!"</li>
                        <li><i>ai don fis em op gon heda</i> "I healed him for the commander"</li>
                        <li><i>ufnes gon homplei</i> "strength for a hunt"</li>
                    </ul>
                    <li><i>raun</i>: (locative) near, around, in, next to; shares origins and meaning with satellite <i>raun</i></li>
                    <ul>
                        <li><i>raun faya, oso wada klin...</i> "in fire, we cleanse..."</li>
                        <li><i>oso na gon emo op raun stegeda</i> "we will fight them near/in the village"</li>
                    </ul>
                    <li><i>ona</i>: (locative) on, under, into</li>
                    <ul>
                        <li><i>em don gyon au ona Maun-de</i> "he went into Mount Weather"</li>
                        <li><i>em laik ona tri</i> "it is on the tree"</li>
                    </ul>
                    <li><i>kom</i>: from, of, with; often indicates belonging or possession</li>
                    <ul>
                        <li><i>em don slip daun kom skai </i>"he fell from the sky"</li>
                        <li><i>Indra kom trigeda</i> "Indra of the forest"</li>
                        <li><i>kom disha kru</i> "with these people"</li>
                    </ul>
                    <li><i>hashta</i>: about, regarding; narrow usage</li>
                    <ul>
                        <li><i>mochof hashta yu prom</i> "thank you for your question"</li>
                        <li><i>em don tel osir op hashta kongeda-de</i> "he told us about the Alliance"</li>
                    </ul>
                </ul></p>
            </div>
            <!--  -->

            <div class="entry" id="de-particle">
                <h2><a href="#de-particle">-de</a></h2>
                <p><p>This emphatic particle is used to denote a specific instance of a noun. It is only used in special cases, so proceed with caution.</p>
                <table class="gloss">
                    <tr class="tgs_gloss"><td>tri-de</td><td>ste</td><td>sen</td><td>yu</td><td>op</td></tr>
                    <tr class="leipzig_gloss"><td>tree-EM</td><td>be</td><td>hear</td><td>2SG</td><td>SAT</td></tr>
                    <tr class="en_text"><td colspan="5">the trees are listening</td></tr>
                </table>
                <p></p>
                <table class="gloss">
                    <tr class="tgs_gloss"><td>yu</td><td>laik</td><td>kongeda-de</td></tr>
                    <tr class="leipzig_gloss"><td>2SG</td><td>be</td><td>alliance-EM</td></tr>
                    <tr class="en_text"><td colspan="3">you are the Alliance</td></tr>
                </table>
                <p></p>
                <table class="gloss">
                    <tr class="tgs_gloss"><td>oso</td><td>wada</td><td>klin</td><td>laudnes-de</td><td>kom</td><td>fotaim</td></tr>
                    <tr class="leipzig_gloss"><td>1PL.INCL</td><td>clean</td><td>SAT</td><td>pain-EM</td><td>from</td><td>past</td></tr>
                    <tr class="en_text"><td colspan="6">we cleanse the pain of the past</td></tr>
                </table>
                <p></p>
                <table class="gloss">
                    <tr class="tgs_gloss"><td>teik</td><td>em</td><td>kamp</td><td>raun</td><td>tribau-de</td></tr>
                    <tr class="leipzig_gloss"><td>take</td><td>3SG</td><td>stay-near</td><td>SAT</td><td>log-EM</td></tr>
                    <tr class="en_text"><td>put him on the log</td></tr>
                </table>
                <p><i>de</i> is also used as part of the demonstrative adjective <i>dei de</i> (see topic "Demonstratives").</p></p>
            </div>
            <!--  -->

            <div class="entry" id="lexical-stress">
                <h2><a href="#lexical-stress">Lexical Stress</a></h2>
                <p>Lexical stress is handled in Trigedasleng the same way it's handled in English--that is, finding the stress isn't always predictable and is mostly a matter of rote memorization. Mostly, you can use your English intuition about where the lexical stress should fall in a word. See citations on this article for more information on lexical stress in Trigedasleng.</p>
            </div>
            <!--  -->

            <div class="entry" id="relative-clauses">
                <h2><a href="#relative-clauses">Relative Clauses</a></h2>
                <p><p>Relative clauses can be formed as in English, without any subordinators or conjunctions.</p>
                <ul>
                    <li><i>gona ai don fis op ste klir</i> "{the warrior I healed} is safe"</li>
                    <li><i>gona ai don led op ge fis op</i> "{the warrior I wounded} is healed"</li>
                    <li><i>ai na gon raun kom gona ai don fis op</i> "I will fight with {the warrior I healed}"</li>
                </ul>
                <p>Relative clauses can also be formed using <i>bilaik</i>, which has no direct counterpart in English. It can introduce "that"/"who"/"which" clauses and hypothetical or conditional clauses.</p>
                <ul>
                    <li><i>gona bilaik don fis ai op ste klir</i> "the warrior {who cured me} is safe"</li>
                    <li><i>gona bilaik ai don fis op ste klir</i> "the warrior {whom I cured} is safe"</li>
                    <li><i>ai don tel em op bilaik oso ste klir</i> "I told him {[that] we are safe}"</li>
                    <li><i>oso souda lok emo op fou bilaik emo hon emo sobwe op</i> "we must locate them before they find the tunnels"</li>
                </ul></p>
            </div>
            <!--  -->

            <div class="entry" id="bilaik">
                <h2><a href="#bilaik">Bilaik</a></h2>
                <p><p><i>Bilaik</i> is probably the most difficult concept of Trigedasleng grammar for speakers of Modern English to grasp. It has many uses, and it's often difficult to tell when to use <i>bilaik</i> over some other word or construction. It has no direct counterpart in Modern English, though it is derived from the "be-like" construction (called "quotative BE LIKE" by some linguists). Some guidelines on use of <i>bilaik</i> follow.</p>

                <h4><b>As a copula</b>:</h4>
                <p><i>Bilaik</i> can be used as a figurative copula, and loosely means "to be ... for all intents and purposes/so to speak." It may be used with the pejorative <i>du</i> when talking about someone not held in respect or regard. (see topic "Copulas")</p>

                <h4><b>As a subordinator</b>:</h4>
                <p><i>Bilaik</i> can be used to introduce subordinate and relative clauses, and is translated as "that"/"who"/"which" in such cases. It can be used to introduce hypothetical or conditional clauses as well (but n.b. <i>taim...taim</i> "if...then"). In some contexts, <i>bilaik</i> can be used to mean "like" or "as" (<i>bilaik yu don tel ai op</i> "like you told me")</p></p>
            </div>
            <!--  -->

        </div>

    </div>
@endsection
