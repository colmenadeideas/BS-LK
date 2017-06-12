package com.colmenadeideas.likes.boards;

import android.app.Activity;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AlertDialog;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.colmenadeideas.likes.R;
import com.colmenadeideas.likes.config.CommonKeys;
import com.colmenadeideas.likes.controllers.ApiController;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import static android.content.DialogInterface.*;

public class AddBoardActivity extends Activity {

    Button button;
    EditText inputName;
    private ProgressDialog pDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_board);


        inputName  = (EditText) findViewById(R.id.name);
        button  = (Button) findViewById(R.id.button);
        button.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                new ProcessAdd().execute();
            }
        });

        /*AlertDialog.Builder builder = new AlertDialog.Builder(AddBoardActivity.this);
        builder.setMessage("Information saved successfully ! Add Another Info?")
                .setCancelable(false)
                .setPositiveButton("No", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        //startActivity(new Intent(((Dialog)dialog).getContext(),CheckPatient.class));
                    }
                })
                .setNegativeButton("Yes", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        dialog.cancel();
                    }
                });
        AlertDialog alert = builder.create();
        dialog = alert;*/
    }




    class ProcessAdd extends AsyncTask<String, String, String> {

        private Handler handler;
        boolean failure = false;


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
               /* pDialog = new ProgressDialog(AddBoard.this);
                pDialog.setMessage(getString(R.string.message_processing));
                pDialog.setIndeterminate(false);
                pDialog.setCancelable(true);
                pDialog.show();*/
            }

            @Override
            protected String doInBackground(String... args) {

                int success;
                String response;
                String name = inputName.getText().toString();
                //Terms
                ArrayList<NameValuePair> params = new ArrayList<NameValuePair>();
                params.add(new BasicNameValuePair("name", name));

                response = null;

                //Intent identify = new Intent(getApplicationContext(), IdentifyActivity.class); //SET A DEFAULT INTENT

                ApiController api = new ApiController();
                JSONObject json = api.add("boards", params);

                //Check for login response
                try{
                    if(json.getString(CommonKeys.TAG_SUCCESS) != null){

                        success = json.getInt(CommonKeys.TAG_SUCCESS);
                        response = json.getString(CommonKeys.KEY_RESPONSE);

                        if(success == 1) {
                            // Launch Dashboard Screen
                            Log.d("Board Success", json.getString(CommonKeys.TAG_SUCCESS));

                            JSONObject createdID = json.getJSONObject("board");
                            response = createdID.toString();
                            return response;

                            /*if (role.equals("doctor")) {
                                identify = new Intent(getApplicationContext(), DashboardActivity.class);
                            }
                            if (role.equals("patient")) {
                                //TODO SET HOME CLASS FOR PATIENT
                                identify = new Intent(getApplicationContext(), IdentifyActivity.class);
                            }
                            //identify.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                            startActivity(identify);
                            finish();
                            */

                        } else {
                            Log.d("Board Failure!", json.getString(CommonKeys.KEY_RESPONSE));
                            return response;

                        }

                   /*
                    if(Integer.parseInt(res) == 1){

                        // user successfully logged in
                        // Store user details in SQLite Database
                        DatabaseHandler db = new DatabaseHandler(getApplicationContext());
                        JSONObject json_user = json.getJSONObject("user");

                        // Clear all previous data in database
                        userFunction.logoutUser(getApplicationContext());
                        db.addUser(json_user.getString(KEY_NAME), json_user.getString(KEY_EMAIL), json.getString(KEY_UID), json_user.getString(KEY_CREATED_AT));

                    */
                    }

                } catch (JSONException e){
                    e.printStackTrace();
               }

                return response;
            }

            @Override
            protected void onPostExecute(String result) {
                // dismiss the dialog once product deleted
                super.onPostExecute(result);
               // pDialog.dismiss();
                //if (file_url != null){
                 //   Toast.makeText(AddBoardActivity.this, "file_url", Toast.LENGTH_LONG).show();
                //}
                Log.d("POST", result+"dd");
                showDialog(AddBoardActivity.this,"Titulo", "Mensaje");

            }

    }
    public void showDialog(Activity activity, String title, CharSequence message) {
        AlertDialog.Builder builder = new AlertDialog.Builder(activity);

        if (title != null) builder.setTitle(title);

        builder.setMessage(message);
        builder.setPositiveButton("OK", null);
        builder.setNegativeButton("Cancel", null);
        builder.show();

    }

}
