package com.colmenadeideas.likes.controllers;

import android.util.Log;

import com.colmenadeideas.likes.libs.JSONParser;
import com.colmenadeideas.likes.config.config;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class ApiController {

    private JSONParser jsonParser;

    private static String baseURL = config.URL+"BS-LK/html/";
    private static String apiURL = config.URL+"BS-LK/html/api/";

    public ApiController() {
        jsonParser = new JSONParser();
    }

    /*public JSONObject add (List<NameValuePair> params) {

        String search_terms = null;

        for (NameValuePair valuePair : params) {
            String temp_var_key = valuePair.getName();
            String temp_var_value = valuePair.getValue();
            Log.d("Pair:", temp_var_key.toString() + " " + temp_var_value.toString());

            if (temp_var_key == "term") {
                search_terms = temp_var_value.toString();
            }
        }

        JSONObject json = jsonParser.getJSONFromUrl(apiURL+"search/other/"+search_terms, "GET", params);
        //Log.e("JSON", json.toString());
        return json;
    }*/

    public JSONObject add(String what, List<NameValuePair> params){

        switch (what) {
            case "boards":
                break;
        }
       // List<NameValuePair> params = new ArrayList<NameValuePair>();
       // params.add(new BasicNameValuePair("name", name));

        // getting JSON Object
        JSONObject json = jsonParser.getJSONFromUrl(baseURL+what+"/add/", "POST", params);
        Log.e("JSON", String.valueOf(json));
        // return json
        return json;
    }
   /* public JSONObject search(List<NameValuePair> params) {

        //setup array containing submitted form data
        ////List<NameValuePair> data = new List<NameValuePair>();

        String search_terms = null;

        for (NameValuePair valuePair : params) {
            String temp_var_key = valuePair.getName();
            String temp_var_value = valuePair.getValue();
            Log.d("Pair:", temp_var_key.toString() + " " + temp_var_value.toString());

            if (temp_var_key == "term") {
                search_terms = temp_var_value.toString();
            }
        }

        JSONObject json = jsonParser.getJSONFromUrl(searchUrl+"search/other/"+search_terms, "GET", params);
        //Log.e("JSON", json.toString());
        return json;
    }
    public JSONObject appointments(List<NameValuePair> params) {
        String search_terms = null;
        for (NameValuePair valuePair : params) {
            String temp_var_key = valuePair.getName();
            String temp_var_value = valuePair.getValue();
            Log.d("Pair:", temp_var_key.toString()+"/"+temp_var_value.toString());

            if (temp_var_key == "term") {
                search_terms = temp_var_value.toString();
            }
        }

        JSONObject json = jsonParser.getJSONFromUrl(searchUrl+"appointments/json/doctor/"+search_terms, "GET", params);
        Log.d("Pair:","appointments/json/doctor/"+search_terms);
        return json;

    }
    public JSONObject appointmentsperDay(List<NameValuePair> params) {
        String search_terms = null;
        for (NameValuePair valuePair : params) {
            String temp_var_value = valuePair.getValue();
            search_terms = temp_var_value.toString();
        }
        JSONObject json = jsonParser.getJSONFromUrl(searchUrl+"appointment/json/doctor/"+search_terms, "URL", null);
        Log.d("Pair2:","appointments/json/doctor/"+search_terms);
        return json;

    }*/

}