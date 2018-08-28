package gq.pheels;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONObject;

import ai.api.AIListener;
import ai.api.android.AIConfiguration;
import ai.api.android.AIService;
import ai.api.model.AIError;
import ai.api.model.AIResponse;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        final AIConfiguration config = new AIConfiguration(getResources().getString(R.string.dialogflow_client_access_token),
                AIConfiguration.SupportedLanguages.English,
                AIConfiguration.RecognitionEngine.System);

        final AIService aiService = AIService.getService(getApplicationContext(), config);

        final TextView t1 = (TextView)findViewById(R.id.t1);

        aiService.setListener(new AIListener() {
            @Override
            public void onResult(AIResponse result) {
                Toast.makeText(getApplicationContext(), result.getResult().getFulfillment().getMessages().toArray()[0].toString(),Toast.LENGTH_LONG).show();
                t1.setText(result.getResult().getFulfillment().getMessages().toArray()[0]);
                try {
                    Global.baseObject = new JSONObject(result.toString());
                    t1.setText(result.getResult().getFulfillment().getMessages().toString());
                }catch (Exception e){
                    Toast.makeText(getApplicationContext(), e.toString(), Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onError(AIError error) {

            }

            @Override
            public void onAudioLevel(float level) {

            }

            @Override
            public void onListeningStarted() {

            }

            @Override
            public void onListeningCanceled() {

            }

            @Override
            public void onListeningFinished() {

            }
        });

        Button b1 = (Button)findViewById(R.id.b1);

        b1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                aiService.startListening();
                Toast.makeText(getApplicationContext(), "listening", Toast.LENGTH_SHORT).show();
            }
        });

    }
}
