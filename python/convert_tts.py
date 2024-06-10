from gtts import gTTS
import sys

if len(sys.argv) != 3:
    print("Usage: convert_tts.py <text> <output_path>")
    sys.exit(1)

text = sys.argv[1]
output_path = sys.argv[2]

tts = gTTS(text=text, lang='id')
tts.save(output_path)
