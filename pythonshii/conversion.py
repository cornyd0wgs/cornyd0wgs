def binary_to_decimal(binary_str):
    return int(binary_str, 2)

def binary_to_octal(binary_str):
    return oct(int(binary_str, 2))[2:]

def binary_to_hex(binary_str):
    return hex(int(binary_str, 2))[2:]

def decimal_to_binary(decimal_int):
    return bin(decimal_int)[2:]

def decimal_to_octal(decimal_int):
    return oct(decimal_int)[2:]

def decimal_to_hex(decimal_int):
    return hex(decimal_int)[2:]

def octal_to_decimal(octal_str):
    return int(octal_str, 8)

def octal_to_binary(octal_str):
    return bin(int(octal_str, 8))[2:]

def octal_to_hex(octal_str):
    return hex(int(octal_str, 8))[2:]

def hex_to_decimal(hex_str):
    return int(hex_str, 16)

def hex_to_binary(hex_str):
    return bin(int(hex_str, 16))[2:]

def hex_to_octal(hex_str):
    return oct(int(hex_str, 16))[2:]

def main():
    print("Number Systems: 1. Binary  2. Decimal  3. Octal  4. Hexadecimal")
    from_map = {'1': 'Binary', '2': 'Decimal', '3': 'Octal', '4': 'Hexadecimal'}
    to_map = from_map.copy()
    print("Convert from:")
    for k, v in from_map.items():
        print(f"{k}. {v}")
    from_choice = input("Enter the number for the source system: ")
    print("Convert to:")
    for k, v in to_map.items():
        print(f"{k}. {v}")
    to_choice = input("Enter the number for the target system: ")

    if from_choice == to_choice:
        print("Source and target systems are the same.")
        return

    value = input(f"Enter the {from_map[from_choice]} value: ")

    try:
        if from_choice == '1':  # Binary
            if to_choice == '2':
                print("Decimal:", binary_to_decimal(value))
            elif to_choice == '3':
                print("Octal:", binary_to_octal(value))
            elif to_choice == '4':
                print("Hexadecimal:", binary_to_hex(value))
        elif from_choice == '2':  # Decimal
            decimal = int(value)
            if to_choice == '1':
                print("Binary:", decimal_to_binary(decimal))
            elif to_choice == '3':
                print("Octal:", decimal_to_octal(decimal))
            elif to_choice == '4':
                print("Hexadecimal:", decimal_to_hex(decimal))
        elif from_choice == '3':  # Octal
            if to_choice == '1':
                print("Binary:", octal_to_binary(value))
            elif to_choice == '2':
                print("Decimal:", octal_to_decimal(value))
            elif to_choice == '4':
                print("Hexadecimal:", octal_to_hex(value))
        elif from_choice == '4':  # Hexadecimal
            if to_choice == '1':
                print("Binary:", hex_to_binary(value))
            elif to_choice == '2':
                print("Decimal:", hex_to_decimal(value))
            elif to_choice == '3':
                print("Octal:", hex_to_octal(value))
        else:
            print("Invalid choice.")
    except ValueError:
        print("Invalid input for the selected number system.")

if __name__ == "__main__":
    main()