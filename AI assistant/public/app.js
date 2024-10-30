const btn = document.querySelector('.talk');
const content = document.querySelector('.content');

// Function to make the browser speak a given sentence
function speak(sentence) {
    const text_speak = new SpeechSynthesisUtterance(sentence);
    text_speak.rate = 1;
    text_speak.pitch = 1;
    window.speechSynthesis.speak(text_speak);
}

// Initialize SpeechRecognition API
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const recognition = new SpeechRecognition();

// Function to send the user's input to the AI API and get a response
async function getAIResponse(userInput) {
    console.log('Sending input to AI:', userInput); // Debugging

    try {
        const response = await fetch('/getAIResponse', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ userInput })
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const data = await response.json();
        console.log('Received AI response:', data.response); // Debugging AI response

        // Handle if response is empty or invalid
        if (!data.response || data.response.trim() === '') {
            throw new Error('AI returned an invalid or empty response');
        }

        return data.response; // Return the AI response from the server
    } catch (error) {
        console.error('Error fetching AI response:', error); // Debugging detailed error
        return "Sorry, I couldn't process that. Please try again."; // Return fallback message on error
    }
}

// Function to send the recognized speech to the AI and speak the response
async function speakThis(message) {
    const speech = new SpeechSynthesisUtterance();
    console.log('Sending message to AI:', message); // Debugging

    try {
        // Fetch the AI-generated response
        const aiResponse = await getAIResponse(message);

        if (!aiResponse || aiResponse.trim() === '') {
            throw new Error('Invalid AI response');
        }

        speech.text = aiResponse; // Set the AI response as the speech text
    } catch (error) {
        console.error('Error:', error); // Debugging
        speech.text = "Sorry, I couldn't process that. Please try again.";
    }

    speech.volume = 1;
    speech.pitch = 1;
    speech.rate = 1;

    window.speechSynthesis.speak(speech); // Make the browser speak the response
}

// Event listener for when the recognition result is returned
recognition.onresult = (event) => {
    const current = event.resultIndex;
    const transcript = event.results[current][0].transcript;
    console.log('Transcript received:', transcript); // Debugging transcript
    content.textContent = transcript; // Display the transcript on the page
    speakThis(transcript.toLowerCase()); // Send the transcript to AI and speak the response
};

// Handle speech recognition errors
recognition.onerror = (event) => {
    console.error('Speech recognition error:', event.error);
    speak('Sorry, there was a network issue with speech recognition. Please try again.');
};

// Start recognition when the button is clicked
btn.addEventListener('click', () => {
    recognition.start();
    console.log('Voice recognition started'); // Debugging voice recognition
});

// Corrected onspeechend event handler
recognition.onspeechend = () => {
    recognition.stop();
    console.log("Speech recognition has stopped.");
};
