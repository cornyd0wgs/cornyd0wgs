def is_prime(n):
    if n <= 1:
        return False
    if n <= 3:
        return True
    if n % 2 == 0 or n % 3 == 0:
        return False
    i = 5
    while i * i <= n:
        if n % i == 0 or n % (i + 2) == 0:
            return False
        i += 6
    return True

def gcd(a, b):
    while b:
        a, b = b, a % b
    return a

def lcm(a, b):
    return abs(a * b) // gcd(a, b)

def mod_inverse(a, m):
    for x in range(1, m):
        if (a * x) % m == 1:
            return x
    return None

def main():
    print("Number Theory Toolkit")
    print("1. Check if a number is prime")
    print("2. Compute GCD of two numbers")
    print("3. Compute LCM of two numbers")
    print("4. Find modular inverse")
    choice = input("Choose an option (1-4): ")

    if choice == '1':
        n = int(input("Enter a number: "))
        print(f"{n} is {'prime' if is_prime(n) else 'not prime'}")
    elif choice == '2':
        a = int(input("Enter first number: "))
        b = int(input("Enter second number: "))
        print(f"GCD({a}, {b}) = {gcd(a, b)}")
    elif choice == '3':
        a = int(input("Enter first number: "))
        b = int(input("Enter second number: "))
        print(f"LCM({a}, {b}) = {lcm(a, b)}")
    elif choice == '4':
        a = int(input("Enter number: "))
        m = int(input("Enter modulus: "))
        inv = mod_inverse(a, m)
        if inv:
            print(f"Modular inverse of {a} mod {m} is {inv}")
        else:
            print(f"No modular inverse exists for {a} mod {m}")
    else:
        print("Invalid choice.")

if __name__ == "__main__":
    main()