from gtts import gTTS
import sys

text = sys.argv[1]
language = 'id'  # Bahasa Indonesia
output_path = sys.argv[2]

tts = gTTS(text=text, lang=language)
tts.save(output_path)
