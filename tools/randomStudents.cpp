#include <bits/stdc++.h>
using namespace std;

string randomName(){
    string Ho[10] = {"Nguyễn", "Trần", "Lê", "Phạm", "Hoành", "Phan", "Vũ", "Đặng", "Ngô", "Đỗ"};
    string TenLot[10] = {"Ái", "An", "Anh", "Bảo", "Công", "Đức", "Gia", "Hoài", "Khải", "Thành"};
    string Ten[10] = {"Hào", "Nam", "Toàn", "Tường", "Phát", "Vinh", "Khánh", "Nhuận", "Hoàng", "Tùng"};

    return Ho[rand() % 10] + " " + TenLot[rand() % 10] + " " + Ten[rand() % 10];
}
int randomAge(){
    return rand() % 4 + 18; 
}
string randomMajor(){
    string major[5] = {"Công nghệ thông tin", "Công nghệ thông tin", "Kiến trúc", "Kinh tế", "Sinh học"};
    return major[rand() % 5];
}
string randomGender(){
    string gender[2] = {"Nam", "Nữ"};
    return gender[rand() % 2];
}
string randomPhone(){
    string phone = "0";
    for (int i = 1; i <= 9; i++){
        if (i == 1) phone += to_string(rand() % 9 + 1);
        else phone += to_string(rand() % 10);
    }
    return phone;
}
string randomString(int len){
    string str = "";
    for (int i = 1; i <= len; i++){
        str += 'a' + (rand() % 26);
    }
    return str;
}
string randomEmail(){
    return randomString(rand() % 5 + 8) + "@" 
        + randomString(3 + rand() % 4) + "." 
        + randomString(3);
}
string randomBirthday(){
    return to_string(2000 + rand() % 4) + "-"
        + to_string(1 + rand() % 12) + "-"
        + to_string(1 + rand() % 30);
}
string randomBirthPlace(){
    string noiSinh[10] = {"Thanh Hoá", "Nghệ An", "Thừa Thiên-Huế", "Đà Nẵng", "Lâm Đồng", "Quảng Ngãi", "Phú Yên", "Quảng Bình", "Quảng Trị", "Khánh Hoà"};
    return noiSinh[rand() % 10];
}

int main(){
    srand(time(nullptr));
    freopen("text.out", "w", stdout);
    
    int number_exist_row = 40;
    int number_row = 15;
    for (int id = number_exist_row + 1; id <= number_row + number_exist_row; id++){
        cout << "(" << id << ", ";
        cout << "'" + randomName() + "'" << ", ";
        cout << randomAge() << ", ";
        cout << "'" + randomMajor() + "'" << ", ";
        cout << "'" + randomGender() + "'" << ", ";
        cout << "'" + randomBirthday() + "'" << ", ";
        cout << "'" + randomBirthPlace() + "'" << ", ";
        cout << "'" + randomPhone() + "'" << ", ";
        cout << "'" + randomEmail() + "'" << "),\n";
    }
    return 0;
}