import cv2
from simple_facerec import SimpleFacerec
import uuid
import os
import time

# Define save path
save_path = "D:\Face Recognition\saved img"

# Encode faces from a folder
sfr = SimpleFacerec()
sfr.load_encoding_images(images_path="D:\Face Recognition\sampelfoto")

# Load Camera
cap = cv2.VideoCapture(0)

# Initialize variables for image capture
is_capturing = False
captured_image = None
last_detection_time = None

while True:
    ret, frame = cap.read()

    # Detect Faces
    face_locations, face_names = sfr.detect_known_faces(frame)
    for face_loc, name in zip(face_locations, face_names):
        y1, x2, y2, x1 = face_loc[0], face_loc[1], face_loc[2], face_loc[3]

        cv2.putText(frame, name, (x1, y1 - 10), cv2.FONT_HERSHEY_DUPLEX, 1, (0, 0, 200), 2)
        cv2.rectangle(frame, (x1, y1), (x2, y2), (0, 0, 200), 4)

        # Capture image after 5 seconds of detection
        if name != "Unknown":
            if last_detection_time is None or time.time() - last_detection_time > 10:
                is_capturing = True
                last_detection_time = time.time()

    # Capture image on pressing 'W' key
    if is_capturing:
        captured_image = frame
        captured_name = name
        is_capturing = False

    cv2.imshow("Frame", frame)

    # Handle keyboard input
    key = cv2.waitKey(1) & 0xFF
    if key == ord('q'):
        break
    elif key == ord('w'):
        is_capturing = True

    # Save captured image if any
    if captured_image is not None:
        try:
            # Generate unique filename
            filename = str(uuid.uuid4()) + ".jpg"
            complete_path = os.path.join(save_path, filename)

            # Save image
            cv2.imwrite(complete_path, captured_image)
            print(f"Image saved to: {complete_path}")
            
            
            
        except Exception as e:
            print(f"Error saving image: {e}")

        captured_image = None

# Close Window
cv2.destroyAllWindows()

