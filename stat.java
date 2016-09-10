package com.batfia.healthpal.Database;

/**
 * Created by Rifat on 26-Aug-16.
 */
public class Stat {
    public static final String TABLE = "stats";

    // Labels Table Columns names
    public static final String KEY_ID = "id";
    public static final String KEY_TYPE = "type";
    public static final String KEY_DATA = "data";
    public static final String KEY_UNIT = "unit";
    public static final String KEY_DATE = "date";

    // property help us to keep data
    public String type,unit;
    public int id;
    public double data;
    public long date;

    //custom keys: written by meha
    // keys for type
    public static final String HEART = "heart_rate", HEARTUNIT = "BPM";
    public static final String TEMP = "temperature", TEMPUNIT_FAR = "°F", TEMPUNIT_DEG = "°C";

    public static final String WEIGHT = "weight", WEIGHTUNIT_KG="kg", WEIGHTUNIT_POUND="lbs";
    public static final String HEIGHTUNIT_CM = "cm", HEIGHTUNIT_INCH = "inch";

    public static final String BP_SYS = "bp_sys", BP_DIA = "bp_dia" , BP_UNIT="mmHg";
    public static final String BS_FAST = "bs_fast", BS_REST = "bs_rest", BSUNIT = "mg/dL";

    public static final String BMI = "bmi";
    public static final String A1C = "a1c";



    public Stat() {
    }

    public Stat(String type, double data, String unit) {
        this.type = type;
        this.unit = unit;
        this.data = data;

        // not a usual db task
        // customized by meha
        this.date = DateConverter.fromTodayDate();
    }
}