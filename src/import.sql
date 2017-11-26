/* lawsuits */
update residents set lawsuit = 0 where lawsuit = "";
update residents set lawsuit = 1 where lawsuit = "מושב ישע";
update residents set lawsuit = 2 where lawsuit = "כפר הס";
update residents set lawsuit = 3 where lawsuit = "כפר מיימון";
update residents set lawsuit = 4 where lawsuit = "זוהר";
update residents set lawsuit = 5 where lawsuit = "מטולה";
update residents set lawsuit = 6 where lawsuit = "שחר";
update residents set lawsuit = 7 where lawsuit = 'פעמי תשז';
update residents set lawsuit = 8 where lawsuit = "רשפון";
update residents set lawsuit = 9 where lawsuit = "נמל אשדוד";
update residents set lawsuit = 10 where lawsuit = "עזריאל";
update residents set lawsuit = 11 where lawsuit = "רוויה";
update residents set lawsuit = 12 where lawsuit = "שירות עד הבית";

/* statuses */
update `residents` set marital_status = 0 WHERE marital_status = '';
update `residents` set marital_status = 1 WHERE marital_status = 'רווק';
update `residents` set marital_status = 2 WHERE marital_status = 'נשוי';
update `residents` set marital_status = 3 WHERE marital_status = 'גרוש';
update `residents` set marital_status = 4 WHERE marital_status = 'אלמן';


/* referral reasons */
update residents set `ref_reason` = 0 where `ref_reason` = "";
update residents set `ref_reason` = 1 where `ref_reason` = 'ימ״ר צפון';
update residents set `ref_reason` = 2 where `ref_reason` = "הומאניטרי";
update residents set `ref_reason` = 3 where `ref_reason` = "סער";
update residents set `ref_reason` = 4 where `ref_reason` = "עדות";
update residents set `ref_reason` = 5 where `ref_reason` = "קורבן עבדות";
update residents set `ref_reason` = 6 where `ref_reason` = "קורבן עבדות ומתן שרותי מין";
update residents set `ref_reason` = 7 where `ref_reason` = "קורבן עבדות ועבודות כפייה";
update residents set `ref_reason` = 8 where `ref_reason` = "קורבן עבדות למן שרותי מין ועבודת כפייה";
update residents set `ref_reason` = 9 where `ref_reason` = "קורבן עבדות למתן שרותי מין";
update residents set `ref_reason` = 10 where `ref_reason` = "ראשית ראייה";
update residents set `ref_reason` = 3 where `ref_reason` = "מחלק סער";
update residents set `ref_reason` = 8 where `ref_reason` = "קורבן עבדות למתן שרותי מין ועבודת כפייה";

/* checkout reasons */
UPDATE `residents` SET `check_out_reason_id` = 1 WHERE `check_out_reason_id` LIKE "%הושם אצל מעסיק%";
UPDATE `residents` SET `check_out_reason_id` = 2 WHERE `check_out_reason_id` = "חזר למעסיק";
UPDATE `residents` SET `check_out_reason_id` = 3 WHERE `check_out_reason_id` = "עבר לעבוד בקיבוץ";
UPDATE `residents` SET `check_out_reason_id` = 4 WHERE `check_out_reason_id` = "חזר לארץ המוצא";
UPDATE `residents` SET `check_out_reason_id` = 5 WHERE `check_out_reason_id` = "יצא מהמקלט ולא חזר";
UPDATE `residents` SET `check_out_reason_id` = 6 WHERE `check_out_reason_id` = "מעבר לדירת המשך";
UPDATE `residents` SET `check_out_reason_id` = 7 WHERE `check_out_reason_id` = "עזב לקנדה";
UPDATE `residents` SET `check_out_reason_id` = 8 WHERE `check_out_reason_id` = "עזב לעבודה בקיבוץ";