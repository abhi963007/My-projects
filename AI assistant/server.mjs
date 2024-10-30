import 'dotenv/config';  // Automatically loads environment variables from .env file
import express from 'express';
import { GoogleGenerativeAI } from '@google/generative-ai';

const app = express();
const port = 3000;

// Use the API key from the environment variables
const apiKey = process.env.API_KEY; // Ensure API_KEY is set in the .env file

// Initialize the Google Generative AI client with the API key
const genAI = new GoogleGenerativeAI(apiKey);

// Middleware to parse JSON requests
app.use(express.json());

// Serve static files from the 'public' directory
app.use(express.static('public'));

// Endpoint to handle AI requests
app.post('/getAIResponse', async (req, res) => {
    const { userInput } = req.body; // Get the user input from the request body

    try {
        console.log("User input received:", userInput);

        // Get the generative model
        const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });
        console.log("Model initialized successfully");

        // Generate content based on the user input
        const result = await model.generateContent(userInput);
        console.log("AI response received:", result);

        if (!result || !result.response || !result.response.text) {
            throw new Error('Invalid AI response');
        }

        // Send the AI-generated response back to the client
        res.json({ response: result.response.text() });
    } catch (error) {
        console.error('Error while generating AI response:', error);

        if (error.response) {
            console.error('Error response from API:', error.response.data);
        }

        res.status(500).json({ error: 'Failed to get response from AI' });
    }
});

// Test route to check server health
app.get('/test', (req, res) => {
    res.json({ message: 'The server is working!' });
});

// Start the server and listen on the specified port
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
